<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;

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
}
