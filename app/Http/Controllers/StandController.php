<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Stand;
use App\User;
use Validator;
use Auth;

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
            $data = $request->all();
            $validator = $this->validateStand($data);

            //If invalid data, send back to form and display errors.
            if ($validator->fails()) {
                $this->throwValidationException(
                    $request, $validator
                );
            }

            //Retrieve this user
            $user = Auth::user();
            //Create a new stand
    		$stand = new Stand;
            $stand->createFromForm($data, $user);

            //Send to view Stand
            $view = Redirect('/');//'/stand/'.$stand->id);//off until view made
    	}
    	else
    	{
    		$view = view('stand.create');
    	}
    	return $view;
    }

    /**
    * Validate a Stand's inputs
    *
    * @param $request - array of post values
    */
    public function validateStand(array $data)
    {
        $rules = [
            'name' => 'required|max:255|unique:stands',
            'description' => 'required|max:4096',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'zip' => 'required|max:255',
        ];
        return Validator::make($data, $rules);
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
