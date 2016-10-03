<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SettingsController extends Controller
{
    //Main view to look at and change your settings
	public function index()
	{
		return view('settings.settings');
	}
}
