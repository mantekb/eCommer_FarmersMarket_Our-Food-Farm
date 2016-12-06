<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\UserAddress;
use Validator;

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

	public function validateName(array $data)
	{
		$rules = [
			'name' => 'required|max:255'
		];
		return Validator::make($data, $rules);
	}

	public function changeName(Request $request)
	{
		//Validate name by DB constraints
		$data = $request->all();
		$validator = $this->validateName($data);

		if ($validator->fails())
		{
			return json_encode(['error' => $validator->errors()->all()]);
		}

		$name = $request->get('name');
		$this->user->name = $name;
		$this->user->save();
		if (!$request->ajax())
		{
			return Redirect('/settings');
		}
		else
		{
			return json_encode([]);
		}
	}

	public function validatePassword(array $data)
	{
		$rules = [
			'new_password'  => 'required|min:6|max:255',
			'conf_password' => 'required|min:6|max:255|same:new_password'
		];
		return Validator::make($data, $rules);
	}

	public function changePassword(Request $request)
	{
        $data = $request->all();
        $validator = $this->validatePassword($data);

        if($validator->fails())
        {
            return json_encode(['error' => $validator->errors()->all()]);
        }

		$new_password = $request->get('new_password');
		$conf_password = $request->get('conf_password');

		$this->user->password = bcrypt($new_password);
		$this->user->save();
		if (!$request->ajax())
		{
			return Redirect('/settings');
		}
		else
		{
			return json_encode([]);
		}
	}

	public function validateAddress(array $data)
	{
		$rules = [
			'address'  => 'required|max:255',
			'city' 	   => 'required|max:255',
			'state'    => 'required|max:255',
			'zip'      => 'required|max:255'
		];
		return Validator::make($data, $rules);
	}

	public function changeAddress(Request $request)
	{
        $data = $request->all();
        $validator = $this->validateAddress($data);

        if($validator->fails())
        {
            return json_encode(['error' => $validator->errors()->all()]);
        }

		$address = $request->get('address');
		$city = $request->get('city');
		$state = $request->get('state');
		$zip = $request->get('zip');
		$lat = $request->get('lat');
		$long = $request->get('long');

		if (!$this->user->hasAddress())
		{
			$user_address = new UserAddress;
		}
		else
		{
			$user_address = $this->user->address;
		}
		$user_address->user_id = $this->user->id;
		$user_address->address = $address;
		$user_address->city = $city;
		$user_address->state = $state;
		$user_address->zip = $zip;
		$user_address->lat = $lat;
		$user_address->long = $long;
		$user_address->save();


		if (!$request->ajax())
		{
			return Redirect('/settings');
		}
		else
		{
			return json_encode([]);
		}
	}

	public function removeStand()
	{
		$stand = $this->user->stand;
		$stand->delete();
	}
}
