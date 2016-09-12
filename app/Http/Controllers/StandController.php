<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class StandController extends Controller
{
    /**
    * Return the create stand view, or save a new stand to the DB and go to stand page.
    *
    * @return $view - Either the input form, or a view of your stand.
    */
    public function create(Request $request)
    {
    	if ($request->isMethod('POST'))
    	{
    		//
    	}
    	else
    	{
    		$view = view('stand.create');
    	}
    	return $view;
    }
}
