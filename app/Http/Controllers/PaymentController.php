<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\PaymentInfo;

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
		$DOBmonth = intval($months[$DOBParts[1]]);
		$DOByear = intval($DOBParts[2]);

		//API Calls
		\Stripe\Stripe::setApiKey(env('STRIPE_TEST_SECRET_KEY'));

		try {
			if (!$this->user->hasPaymentInfo())
			{
				$acct_info = \Stripe\Account::create(array(
					"managed" => true,
					"country" => "US",
					"legal_entity" => array(
						"type" => "individual",
						"first_name" => $firstname,
						"last_name" => $lastname,
						"dob" => array(
							"day" => $DOBday,
							"month" => $DOBmonth,
							"year" => $DOByear
						),
						"address" => array(
							"line1" => $address,
							"city" => $city,
							"state" => $state,
							"postal_code" => $zip
						)
					)
				));
			}
			else
			{
				$acct_info = \Stripe\Account::retrieve($this->user->paymentInfo->stripe_id);
			}

			$cardToken = \Stripe\Token::create(array(
				"card" => array(
					"number" => $cardNumber,
					"exp_month" => $expDateMonth,
					"exp_year" => $expDateYear,
					"cvc" => $cvc,
					"currency" => "usd"
				)
			));

			$acct_info->external_accounts->create(array(
				"external_account" => $cardToken["id"],
				"default_for_currency" => true
			));

		} catch(\Stripe\Error\InvalidRequest $e) {
            //One of the \Stripe\Account requests above failed.
			return json_encode(['error' => $e->getMessage()]);
        } catch(\Stripe\Error\Card $e) {
            //The \Stripe\Card request above failed.
        	return json_encode(['error' => $e->getMessage()]);
        }

		//Save Data to the Database
		if (!$this->user->hasPaymentInfo())
		{
			$payment_info = new PaymentInfo;
		}
		else
		{
			$payment_info = $this->user->paymentInfo;
		}

		$payment_info->user_id = $this->user->id;
		$payment_info->stripe_id = $acct_info["id"];
		if (!$this->user->hasPaymentInfo())
		{
			$payment_info->secret_key = $acct_info["keys"]["secret"];
			$payment_info->publishable_key = $acct_info["keys"]["publishable"];
		}
		$payment_info->card_token_id = $cardToken["id"];
		$payment_info->last_four = $cardToken["card"]["last4"];
		$payment_info->save();

		if (!$request->ajax())
		{
			return Redirect('/payment');
		}
	}
}
