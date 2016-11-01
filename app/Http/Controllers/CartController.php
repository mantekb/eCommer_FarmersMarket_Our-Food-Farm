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

    	//Return for updating side-cart slide-out
    	return view('shopping.cart-table', ['cart' => $cart]);
    }

    /**
    * Completely remove a product from the cart.
    *
    * @param $product - to remove
    */
    public function remove(Product $product)
    {
        if (Session::has('cart'))
        {
            $cart = Session::get('cart');
            $cart->remove($product);
            Session::set('cart', $cart);
        }
        else
        {
            //Do nothing if not cart exists, faulty post method.
        }
        return view('shopping.cart-table', ['cart' => $cart]);
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

    public function getTotalQuantityAndPrice()
    {
        $totals = [];
        if (Session::has('cart'))
        {
            $cart = Session::get('cart');
            $totals = [
                'quantity' => $cart->getTotalQuantity(),
                'price' => $cart->getTotalPrice()
            ];
        }
        return json_encode($totals);
    }
}
