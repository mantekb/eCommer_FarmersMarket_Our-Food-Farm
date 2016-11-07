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
    private $hasCart = false;
    private $cart;

    public function __construct()
    {
        if (Session::has('cart'))
        {
            $this->cart = Session::get('cart');
            $this->hasCart = true;
        }
    }

    /**
    * Add a product to the cart
    *
    * @
    */
    public function add(Product $product, Request $request)
    {
    	// $user = Auth::user();
    	//check if a cart exists in the session
    	if ($this->hasCart)
    	{
    		$cart = $this->cart;
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
        if ($this->hasCart)
        {
            $cart = $this->cart;
            $cart->remove($product);
            Session::set('cart', $cart);
        }
        else
        {
            //Do nothing if not cart exists, faulty post method.
            abort(403);
        }
        return view('shopping.cart-table', ['cart' => $cart]);
    }

    /**
    * Update quantity of a product in the cart.
    *
    * @param $product - to update
    * @param $quantity - the new quantity for that product
    */
    public function update(Product $product, $quantity)
    {
        if ($this->hasCart)
        {
            $cart = $this->cart;
            $cart->update($product, $quantity);
            Session::set('cart', $cart);
        }
        else
        {
            abort(403);
        }
        return view('shopping.cart-table', ['cart' => $cart]);
    }

    public function view()
    {
    	if ($this->hasCart)
    	{
	    	$cart = $this->cart;
    	}
    	else
    	{
    		$cart = false;
    	}
    	return view('shopping.view-cart', ['cart' => $cart]);
    }

    public function getTotalQuantityAndPrice()
    {
        $totals = ['error' => 'No Cart'];
        if ($this->hasCart)
        {
            $cart = $this->cart;
            $totals = [
                'quantity' => $cart->getTotalQuantity(),
                'price' => $cart->getTotalPrice()
            ];
        }
        return json_encode($totals);
    }
}
