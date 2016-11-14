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
    * Submit what type of payment we are using.
    *
    * @
    */
    public function payChoose(Request $request)
    {
        $payType = $request->get('payType');
        //Set up payment method based on type chosen.
        if ($payType === "payCard")
        {
            $ccInfo = [];
            $ccInfo['ccNum'] = $request->get('ccNum');
            $ccInfo['ccCVC'] = $request->get('ccCVC');
            $ccInfo['ccMonth'] = $request->get('ccMonth');
            $ccInfo['ccYear'] = $request->get('ccYear');
        }
    }

    /**
    * Show an error if it happens during checkout
    *
    * @param $type - Type of error to report.
    *
    * @return $view with params - params is the array of variables for the page.
    */
    public function showError($type)
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
    		case 'unicorns':
    			$title = "";
    			$message = "";
    			$btn = "";
    			$link = "";
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
