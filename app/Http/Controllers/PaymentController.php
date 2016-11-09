<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;

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

	public function createStripeAccount(Request $request)
	{
		$months = [
			"January" => 1,
			"February" => 2,
			"March" => 3,
			"April" => 4,
			"May" => 5,
			"June" => 6,
			"July" => 7,
			"August" => 8,
			"September" => 9,
			"October" => 10,
			"November" => 11,
			"December" => 12
		];

		$firstname = $request->get('firstname');
		$lastname = $request->get('lastname');
		$cardNumber = $request->get('cardNumber');
		$expDate = $request->get('expDate');
		$cvc = $request->get('cvc');
		$DOB = $request->get('DOB');
		$address = $request->get('address');
		$city = $request->get('city');
		$state = $request->get('state');
		$zip = $request->get('zip');

		//Convert Card Expiration Date to Numbers
		$expDateParts = explode('/', $expDate);
		$expDateMonth = intval($expDateParts[0]);
		$expDateYear = intval($expDateParts[1]);

		//Convert Date of Birth to Numbers
		$DOBParts = explode(' ', $DOB);
		$DOBParts[1] = str_replace(',', '', $DOBParts[1]);
		$DOBday = intval($DOBParts[0]);
		$DOBmonth = $months[$DOBParts[1]];
		$DOByear = intval($DOBParts[2]);
	}
}
