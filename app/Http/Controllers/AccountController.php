<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderItems;
use App\Http\Requests;
use Auth;

class AccountController extends Controller
{
	function __construct()
	{
		$this->user = Auth::user();
	}

    /**
    * Show all orders a customer has made
    *
    * @
    */
    public function orders()
    {
        $orders = [];
        if ($this->user->hasOrders())
        {
        	$orders = $this->user->orders;
        }
    	return view('account.orders', ['orders' => $orders]);
    }

    /**
    * Display details about a specific Order.
    *
    * @param $id - id of Order Object to retrieve
    */
    public function order($id)
    {
    	$order = Order::find($id);
    	return view('account.order', ['order' => $order, 'items' => $order->items]);
    }
}
