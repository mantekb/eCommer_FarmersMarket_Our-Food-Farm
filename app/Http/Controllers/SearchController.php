<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;

class SearchController extends Controller{
	public function getResults(Request $request){
		$latDif = $request->get('latDif');
		$longDif = $request->get('longDif');
		$lat = $request->get('lat');
		$long = $request->get('long');
		$search = $request->get('val');
		$high = intval(trim($request->get('high')));
		$low = intval(trim($request->get('low')));

		//If we're just using the zipcode to search
		if ($search == ""){
			$stands = DB::table('stand_addresses')
					 ->join('stands', 'stand_addresses.stand_id', '=', 'stands.id')
                     ->select('stands.name', 'lat', 'stand_addresses.long')
                     ->where([
						    ['lat', '>=', $lat-$latDif],
						    ['lat', '<=', $lat+$latDif],
						    ['stand_addresses.long', '>=', $long-$longDif],
						    ['stand_addresses.long', '<=', $long+$longDif]
						])
                     ->whereExists(function ($query) use ($high, $low) {
			                $query->select(DB::raw(1))
			                      ->from('products')
			                      ->leftJoin('stand_products', 'stand_products.product_id', '=', 'products.id')
			                      ->where([
									    ['stands.id', '=', 'stand_products.stand_id'], //causing exclusions
									    ['products.price', '<=', $high],
									    ['products.price', '>=', $low]
									]);
					 })
                     ->get();
		} else {
			$search = '%'.$search.'%';
			$stands = DB::table('stands')
					->join('stand_addresses', 'stand_addresses.stand_id', '=', 'stands.id')
					->leftJoin('stand_products', 'stand_products.stand_id', '=', 'stands.id')
					->leftJoin('products', 'stand_products.product_id', '=', 'products.id')
                    ->select('stands.name', 'lat', 'long')
                    ->where([
						    ['lat', '>=', $lat-$latDif],
						    ['lat', '<=', $lat+$latDif],
						    ['long', '>=', $long-$longDif],
						    ['long', '<=', $long+$longDif]
						])
					->where(function ($query) use ($search) {
						$query->where('stands.description', 'LIKE', $search)
						    ->orWhere('stands.name', 'LIKE', $search)
						    ->orWhere('products.name', 'LIKE', $search);
					})
                    ->get();
		}

		return $stands;
	}
}