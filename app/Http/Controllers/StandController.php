<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Stand;

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
    		$stand = new Stand;
            $stand->createFromForm($request);
            // validate and return correct place?
            // $view = Redirect('/stand/'.$stand->id);
    	}
    	else
    	{
    		$view = view('stand.create');
    	}
    	return $view;
    }

    /**
    * View the store page for that stand.
    *
    * @param $stand - Automatically detected Stand by laravel.
    */
    public function view(Stand $stand)
    {
        return view('stand.view', ['stand' => $stand]);
    }
}
