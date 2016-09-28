<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Location;

class LocationController extends Controller
{
    //Gets the lat/long based on the zipcode given in the request
	public function getCoords(Request $request){
		$result = [];
		$zipToFind = $request->get('zip');
		$location = Location::where('zip', $zipToFind)->first();
		if ($location == null)
			$result = ['error' => 'Location not found.'];
		else
			$result = ['Lat' => $location->lat, 'Long' => $location->long];
		return json_encode($result);
	}

	public function saveGeoLocation(Request $request){
		$location = new Location;
		$location->zip = $request->get('zip');
		$location->lat = $request->get('lat');
		$location->long = $request->get('long');
		$location->save();
	}
}
