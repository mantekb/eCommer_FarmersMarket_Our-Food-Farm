<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
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
    	$orders = $this->user->orders;
    	return view('account.orders', ['orders' => $orders]);
    }

    /**
    * Display details about a specific Order.
    *
    * @param $order - Order Object to retrieve
    */
    public function order(Order $order)
    {
    	dd($order);
    }
}
