<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ShoppingController extends Controller
{
    public function deals()
    {
    	return view('shopping.deals');
    }
}
