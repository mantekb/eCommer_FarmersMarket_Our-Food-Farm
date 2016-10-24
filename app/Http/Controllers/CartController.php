<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Classes\Cart;
use App\Http\Requests;
use Auth;
use Session;

class CartController extends Controller
{
    /**
    * Add a product to the cart
    *
    * @
    */
    public function add(Product $product, Request $request)
    {
    	// $user = Auth::user();
    	//check if a cart exists in the session
    	if (Session::has('cart'))
    	{
    		$cart = Session::get('cart');
    	}
    	else
    	{
	    	$cart = new Cart;
    	}

    	//Cart object handles adding one
    	$cart->add($product, $request->get('quantity'));

    	//Save the cart to the session
    	Session::set('cart', $cart);

    	//Return for javascript
    	return json_encode($cart);
    }

    public function view()
    {
    	if (Session::has('cart'))
    	{
	    	$cart = Session::get('cart');
    	}
    	else
    	{
    		$cart = false;
    	}
    	return view('shopping.view-cart', ['cart' => $cart]);
    }
}
