<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\UserAddress;

class PaymentController extends Controller
{
   private $user;

	public function __construct()
	{
		$this->user = Auth::user();
	}
    //Main view to look at and change your settings
	public function PaymentInfo()
	{
		return view('payment.paymentinfo', ['user'=>$this->user]);
	}
}
