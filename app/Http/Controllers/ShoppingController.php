<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests;

class ShoppingController extends Controller
{
    public function deals()
    {
    	$products = Product::all();
    	return view('shopping.deals', ['products' => $products]);
    }
}
