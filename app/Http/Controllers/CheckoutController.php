<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Mail;
use Session;
use App\Http\Requests;
use App\User;

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
        //Get the list of stands and products that were ordered.
        $stands = $this->cart->standsToVisit();

        //Set up payment method based on type chosen.
        $payType = $request->get('payType');
        if ($payType !== "payCash")
        {
            foreach ($stands as $stand) {
                $error = $this->makePayment($payType, $request, $stand);
                if ($error)
                    return $error;
            }
        }

        //Edit stock of items, save checkout details, remove from session.
        $this->cart->placeOrder($this->user->id, $payType);

        //Send mails to the buyer and sellers.
        $this->mailUser($stands);

        return view('shopping.order-complete', [
            'cart' => $this->cart,
            'stands' => $stands
        ]);
    }

    /**
    * Use the Stripe API to make a payment.
    *
    * @param $payType - type of payment we are making
    * @param $request - post data passed in
    * @param $stand - Stand we are paying and the products we're buying.
    */
    public function makePayment($payType, $request, $stand)
    {
        //API Calls
        \Stripe\Stripe::setApiKey(env('STRIPE_TEST_SECRET_KEY'));

        //Things may fail, catch them.
        try {
            //Stand's stripe account so we can pay them.
            $payToAccount = $stand['stand']->user->paymentInfo->stripe_id;

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
                    "amount" => ($stand['totalPrice'] * 100),
                    "currency" => "usd",
                    //Card token we just obtained.
                    "source" => $cardToken['id'],
                    "description" => "Our Food Farm Purchase"
                ),
                array(
                    'stripe_account' => $payToAccount
                ));
            }
            else if ($payType === "savedCC")
            {
                //Charge and save the new token for this user.
                $charge = \Stripe\Charge::create(array(
                    // Amount in cents
                    "amount" => ($stand['totalPrice'] * 100),
                    "currency" => "usd",
                    //Stripe Customer ID instead of token- NOT WORKING FOR SOME REASON
                    //Possibly because no ssnLastFour associated with account?
                    "source" => $this->user->paymentInfo->stripe_id,
                    "description" => "Our Food Farm Purchase"
                ),
                array(
                    'stripe_account' => $payToAccount
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
    * Send an email to the user that is similar to the checkout view.
    *
    * @param $stands
    */
    public function mailUser($stands)
    {
        try {
            Mail::send('shopping.order-complete', ['stands' => $stands, 'user' => $this->user], 
            function($m) use ($stands, $user) {
                $m->from('noreply@ourfoodfarm.com', 'Our Food Farm');
                $m->to($user->email, $user->name)->subject('Order Confirmation');
            });
        } catch (\Exception $e) {
            //Do nothing on failure.
        }
        $this->mailSellers($stands);
    }

    /**
    * Sends an email to each stand owner.
    *   Could expand to use text and other methods.
    * @param $stands
    */
    public function mailSellers($stands)
    {
        foreach ($stands as $stand) {
            try {
                //Possibly make a table-ized view and use the laravel mail instead?
                $message = $this->user->name.' has purchased these items from you: <br>';
                foreach ($stand['products'] as $product) {
                    $message .= $product->quantity." of ".$product->name."<br>";
                }
                $message .= "Make sure you put those products aside!";

                //Mail plain text
                mail($stand->user->email, "Order", $message);
            } catch (\Exception $e) {
                //Do nothing on failure.
            }
        }
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
