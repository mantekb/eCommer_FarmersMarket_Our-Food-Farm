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

            //Send to set payment information.
            $view = Redirect('/payment');
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
    * Validate a Stand's inputs when it is being edited. There are slightly different requirements.
    *
    * @param $request - array of post values
    * @param $stand   - the stand, needed to allow users to keep their current stand name
    */
    public function validateEditOfStand(array $data, Stand $stand)
    {
      $rules = [
            'name' => 'required|max:255|unique:stands,name,'.$stand->id,
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
        $params = ['stand' => $stand];
        if ($stand->hasProducts())
        {
            $params += ['products' => $stand->products];
        }
        return view('stand.view', $params);
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
            //Data Validation
            $data = $request->all();
            $validator = $this->validateEditOfStand($data, $stand);

            if ($validator->fails()) {
                $this->throwValidationException(
                    $request, $validator
                );
            }

            $name =        $request->get('name');
            $description = $request->get('description');
            $address =     $request->get('address');
            $city =        $request->get('city');
            $state =       $request->get('state');
            $zip =         $request->get('zip');
            $lat =         $request->get('lat');
            $long =        $request->get('long');

            $stand->name = $name;
            $stand->description = $description;
            $stand->address->address = $address;
            $stand->address->city = $city;
            $stand->address->state = $state;
            $stand->address->zip = $zip;
            $stand->address->lat = $lat;
            $stand->address->long = $long;

            $stand->save();
            $stand->address->save();

            //Create View for Return
            $params = ['stand' => $stand];
            if ($stand->hasProducts())
            {
                $params += ['products' => $stand->products];
            }
            $view = view('stand.view', $params);
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
            //Only allow posting products if payment information is set.
            if (Auth::user()->hasPaymentInfo())
            {
                if ($request->get('type') == 'new')
                {
                    // TODO: 
                    // Something similar to stand creation where we validate and pass back erors
                    // And then we'd be able to clean this section up by passing the data into a constructor.
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
                    // $view = json_encode($product);
                    $view = view('stand.product-card', ['product' => $product, 'edit' => true]);
                }
                else
                {
                    //Editing an existing product
                    $product_id = $request->get('product_id');
                    $productExists = StandProducts::where('product_id', $product_id)
                        ->where('stand_id', $stand->id)
                        ->first();
                    if ($productExists == null)
                    {
                        //No product by that ID was found for this stand, prevent them from moving forward
                        $view = json_encode(['error' => 'You do not have access to this product.']);
                    }
                    else
                    {
                        $product = Product::find($product_id);
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
                //No payment information set
                $view = json_encode(['error' => 'You must set payment information before creating products.']);
            }
        }
        else
        {
            $view = view('stand.products', ['stand' => $stand]);
        }
        return $view;
    }
}
