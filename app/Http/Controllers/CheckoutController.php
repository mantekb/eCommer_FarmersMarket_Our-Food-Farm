<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Http\Requests;

class CheckoutController extends Controller
{
    private $user;
    private $cart;

    public function __construct()
    {
    	$this->middleware('checkout', ['except' => [
    		'showError',
    	]]);
    	$this->user = Auth::user();
    	$this->cart = Session::get('cart');
    }

    /**
    * Send to the beginning of the checkout process.
    *
    * @
    */
    public function index()
    {
    	$paymentInfo = false;
    	//Check if they have payment info saved.
    	if ($this->user->hasPaymentInfo())
    	{
    		$paymentInfo = $this->user->paymentInfo;
    	}
    	return view('shopping.checkout', [
    		'user' => $this->user,
    		'cart' => $this->cart,
    		'paymentInfo' => $paymentInfo,
    	]);
    }

    /**
    * Submit the payment to stripe, place the order in the DB, send emails.
    *
    * @return Redirect back with errors, or proceed to showing where to go.
    */
    public function checkout(Request $request)
    {
        //Set up payment method based on type chosen.
        $payType = $request->get('payType');
        if ($payType !== "payCash")
        {
            $error = $this->makePayment($payType, $request);
            if ($error)
                return $error;
        }

        //Edit stock of items, save checkout details, remove from session.
        $this->cart->placeOrder();

        //Get the list of stands and products that were ordered.
        $stands = $this->cart->standsToVisit();

        //Send mails to the buyer and sellers.
        //

        return view('shopping.order-complete', [
            'cart' => $this->cart,
            'stands' => $stands
        ]);
    }

    /*TODO: I just realized this function doesn't pay the stand, but pays us instead,
    make sure to switch that over. It may be best to obtain stands from the cart,
    then to do this function and loop through and pay the stripe account
    for ech of those stands.*/
    /**
    * Use the Stripe API to make a payment.
    *
    * @param $payType - type of payment we are making
    * @param $request - post data passed in
    */
    public function makePayment($payType, $request)
    {
        //API Calls
        \Stripe\Stripe::setApiKey(env('STRIPE_TEST_SECRET_KEY'));

        //Things may fail, catch them.
        try {
            if ($payType === "payCard")
            {
                //Create a token to charge 
                $cardToken = \Stripe\Token::create(array(
                    "card" => array(
                        "number" => $request->get('ccNum'),
                        "exp_month" => $request->get('ccMonth'),
                        "exp_year" => $request->get('ccYear'),
                        "cvc" => $request->get('ccCVC'),
                        "currency" => "usd"
                    )
                ));

                //Do a single charge.
                $charge = \Stripe\Charge::create(array(
                    // Amount in cents
                    "amount" => ($this->cart->getTotalprice() * 100),
                    "currency" => "usd",
                    //Card token we just obtained.
                    "source" => $cardToken['id'],
                    "description" => "Our Food Farm Purchase"
                ));
            }
            else if ($payType === "savedCC")
            {
                //Charge and save the new token for this user.
                $charge = \Stripe\Charge::create(array(
                    // Amount in cents
                    "amount" => ($this->cart->getTotalprice() * 100),
                    "currency" => "usd",
                    //Stripe Customer ID instead of token
                    "customer" => $this->user->paymentInfo->stripe_id,
                    "description" => "Our Food Farm Purchase"
                ));
            }
        } catch(\Stripe\Error\Card $e) {
            //The card has been declined.
            return $this->showError('card', $e->getMessage());
        }

        //Return false if nothing went wrong.
        return false;
    }

    /**
    * Show an error if it happens during checkout
    *
    * @param $type - Type of error to report.
    *
    * @return $view with params - params is the array of variables for the page.
    */
    public function showError($type, $mess="")
    {
    	switch ($type) {
    		case 'login':
    			$title = "You need to login.";
    			$message = "Click the login button above, or the link below to proceed to login. 
    				You can checkout after you do so.";
    			$btn = "Login";
    			$link = "/login";
    			break;
    		case 'cart':
    			$title = "You don't have anything in your cart!";
    			$message = "Check out the map to search for stands in your area. 
    				You can add items to your cart from there.";
    			$btn = "Go To Map";
    			$link = "/home";
    			break;
    		case 'card':
    			$title = "There was an issue processing your card.";
    			$message = $mess;
    			$btn = "Re-Enter Payment Information";
    			$link = "/checkout";
    			break;
    		default:
    			$title = "An unknown error happened.";
    			$message = "Please try your request again.";
    			$btn = "Go Home";
    			$link = "/home";
    			break;
    	}
    	return view('shopping.error', [
    		'title' => $title,
    		'message' => $message,
    		'btn' => $btn,
    		'link' => $link
    	]);
    }
}
