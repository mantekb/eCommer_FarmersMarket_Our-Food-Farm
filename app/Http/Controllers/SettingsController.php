<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\UserAddress;

class SettingsController extends Controller
{
	private $user;

	public function __construct()
	{
		$this->user = Auth::user();
	}
    //Main view to look at and change your settings
	public function index()
	{
		return view('settings.settings', ['user'=>$this->user]);
	}

	public function changeName(Request $request)
	{
		$name = $request->get('name');
		$this->user->name = $name;
		$this->user->save();
		if (!$request->ajax())
		{
			return Redirect('/settings');
		}
	}

	public function changePassword(Request $request)
	{
		$new_password = $request->get('new_password');
		$conf_password = $request->get('conf_password');
		if ($new_password == $conf_password)
		{
			$this->user->password = $new_password;
			$this->user->save();
			if (!$request->ajax())
			{
				return Redirect('/settings');
			}
		}
	}

	public function changeAddress(Request $request)
	{
		$address = $request->get('address');
		$city = $request->get('city');
		$state = $request->get('state');
		$zip = $request->get('zip');
		$coordinates = $request->get('coordinates');

		$user_address = new UserAddress;
		$user_address->user_id = $this->user->id;
		$user_address->address = $address;
		$user_address->city = $city;
		$user_address->state = $state;
		$user_address->zip = $zip;
		$user_address->lat = $coordinates.lat;
		$user_address->long = $coordinates.long;
		$user_address->save();


		if (!$request->ajax())
		{
			return Redirect('/settings');
		}
	}

	public function removeStand()
	{
		$stand = $this->user->stand;
		$stand->delete();
	}
}
