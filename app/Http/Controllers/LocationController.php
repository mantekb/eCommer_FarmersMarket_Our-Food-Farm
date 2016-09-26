<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class LocationController extends Controller
{
    //Gets the lat/long based on the zipcode given in the request
	public function getGeoLocation(Request $request){
		$location = Location::where('zip', $request->get('zip'));
	}

	private function saveGeoLocation(Request $request){
		$location = new Location;
		$location->zip = $request->zip;
		$location->lat = $request->lat;
		$location->long = $request->long;
		$location->save();
	}
}
