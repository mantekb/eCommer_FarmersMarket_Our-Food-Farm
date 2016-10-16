<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;
use App\Stand;
use App\StandProducts;
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
            $view = Redirect('/stand/'.$stand->id);
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

    /**
    * Edit view and method for a user's stand.
    *
    * @return $view - Either the form or the redirect.
    */
    public function edit(Request $request)
    {
        $stand = Auth::user()->stand;
        if ($request->isMethod('POST'))
        {
            //
        }
        else
        {
            $view = view('stand.edit', ['stand' => $stand]);
        }
    return $view;
    }

    /**
    * View, edit, and create products for your stand
    *
    * @return $view - 
    */
    public function products(Request $request)
    {
        $stand = Auth::user()->stand;
        if ($request->isMethod('POST'))
        {
            if ($request->get('type') == 'new')
            {
                //Create the new product
                $product = new Product;
                $product->name          = $request->get('name');
                $product->description   = $request->get('description');
                $product->price         = $request->get('price');
                $product->stock         = $request->get('stock');
                $product->save();
                //Now associate the new product with the stand.
                $stand->addProduct($product);
                //Since we create through ajax, return full product information back to display.
                $view = json_encode($product);
            }
            else
            {
                //Editing an existing product
                $product_id = $request->get('product_id');
                $product = StandProducts::where('product_id', $product_id)
                    ->where('stand_id', $stand->id)
                    ->first();
                if ($product == null)
                {
                    //No product by that ID was found for this stand, prevent them from moving forward
                    $view = json_encode(['error' => 'You do not have access to this product.']);
                }
                else
                {
                    //Allow editing that product
                    $product->name          = $request->get('name');
                    $product->description   = $request->get('description');
                    $product->price         = $request->get('price');
                    $product->stock         = $request->get('stock');
                    $product->save();
                    $view = json_encode($product);
                }
            }
        }
        else
        {
            $view = view('stand.products', ['stand' => $stand]);
        }
        return $view;
    }
}
