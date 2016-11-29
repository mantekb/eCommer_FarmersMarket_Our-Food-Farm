<?php 

namespace App\Classes;

use App\Product;
use App\Order;
use App\OrderItems;
use Session;

class Cart
{
	/**
	* All the products within this cart.
	*
	* @var - array
	*/
	public $members = [];


	/**
	* Handle adding something to the cart.
	* Either add a new item, or increment the quantity of an existing item.
	*
	* @param $product - Product object, we add the quantity here.
	* @param $quantity - How many of the product we want.
	*/
	public function add($product, $quantity)
	{
		$index = $this->getIndex($product);
		$this->checkQuantity($index, $product, $quantity);
		if ($index == -1)
		{
			//Set the quantity of the new item.
			$product->quantity = $quantity;
			//If the part isn't in the cart yet, just add it in.
			$this->members[] = $product;
		}
		else
		{
			//If the part is in the cart, increment the quantity
			$this->members[$index]->quantity += $quantity;
			//Also update the stock to what currently is set for that product.
			$this->members[$index]->stock = $product->stock;
		}
		//Save this to the Session.
		$this->persist();
	}

	/**
	* Completely remove an item from the cart.
	*
	* @param $product - The Product we are removing.
	*/
	public function remove($product)
	{
		//Denotes if the object has not been removed.
		$removed = false;
		$index = $this->getIndex($product);
		if ($index != -1)
		{
			//Remove item from the cart at $index, only 1 item.
			array_splice($this->members, $index, 1);
			$removed = true;
		}
		$this->persist();
		return $removed;
	}

	/**
	* Updates the quantity of a single item
	*
	* @param $product - Product to edit.
	* @param $quantity - The NEW quantity for the item.
	*/
	public function update($product, $quantity)
	{
		//Was the product updated?
		$updated = false;
		$index = $this->getIndex($product);
		$this->checkQuantity($index, $product, $quantity);
		if ($index != -1)
		{
			$this->members[$index]->quantity = $quantity;
		}
		return $updated;
	}

	/**
	* Obtain the index of a product.
	*
	* @param $product - What we are searching for.
	*/
	public function getIndex($product)
	{
		//-1 if not found
		$index = -1;
		$i = 0;
		$numMembers = count($this->members);
		while ($i < $numMembers && $index == -1)
		{
			if ($this->members[$i]->id == $product->id)
			{
				$index = $i;
			}
			$i++;
		}
		return $index;
	}

	/**
	* Ensure the user isn't trying to add more to their cart than exists.
	*
	* @param $index - index of that product in this cart
	* @param $product - the actual product, so we can ensure to check most recent version
	* @param $quantity - quantity requested
	*/
	public function checkQuantity($index, $product, $quantity)
	{
		if ($index == -1)
		{
			//Product is not yet in cart, just ensure stock isn't less than quantity.
		}
		else
		{
			//Set the quantity equal to what is requested and what we have.
			$quantity += $this->members[$index]->quantity;
		}

		//Make sure the quantity doesn't bring the stock below 0.
		if (($product->stock - $quantity) < 0)
		{
			//Conflict with the state of the resource.
			abort(409);
		}
	}

	/**
	* Get the total quantity of all items in the cart.
	*
	* @return $totalQuant
	*/
	public function getTotalQuantity()
	{
		$totalQuant = 0;
		// Using a foreach here because it passes by value, not reference.
		foreach ($this->members as $product) {
			$totalQuant += $product->quantity;
		}
		return $totalQuant;
	}

	/**
	* Calculate the total price of all items in cart.
	*
	* @return $totalPrice
	*/
	public function getTotalPrice()
	{
		$totalPrice = 0;
		foreach ($this->members as $product) {
			$totalPrice += $product->quantity * $product->price;
		}
		return number_format($totalPrice, 2);
	}

	/**
	* Changes the stock of each item upon placing an order.
	* Also saves this order in the DB.
	*
	* @param $user_id - User id of the user placing the order.
	* @param $payType - payment type for paying the order.
	*/
	public function placeOrder($user_id, $payType)
	{
		//Create the order object and add the products to the order.
		$order = new Order;
		$order->user_id = $user_id;
		$order->paid_with = str_replace("pay", "", $payType);
		$order->save();

		//Edit the stock remaining for the product.
		foreach ($this->members as $product) {
			//Add the product to the order.
			$orderItems = new OrderItems;
			$orderItems->order_id = $order->id;
			$orderItems->quantity = $product->quantity;
			$orderItems->product_id = $product->id;
			$orderItems->name = $product->name;
			$orderItems->description = $product->description;
			$orderItems->price = $product->price;
			$orderItems->save();

			//Mess with the stock for the current product.
			//We set a new one so unsetting the quantity doesn't affect other variables.
			$prodToChange = Product::find($product->id);
			$prodToChange->stock -= $product->quantity;
			$prodToChange->save();
		}

		//Remove this cart from the session.
		$this->forget();
	}

	/**
	* Get the list of stands and products in this cart, for that stand.
	*
	* @return $stands - object holding stand information and also products that were bought
	*/
	public function standsToVisit()
	{
		$stands = [];
		$numMembers = count($this->members);
		for($i = 0; $i < $numMembers; $i++) {
			//Stand for the current product.
			$stand = $this->members[$i]->stand[0];

			//Essentially getIndex() for the stands array
			$inStands = -1;
			$j = 0;
			$numStands = count($stands);
			while ($j < $numStands && $inStands == -1)
			{
				//Check to see if the stand is already in our array
				if ($stands[$j]['stand']->id == $stand->id)
				{
					$inStands = $j;
				}
				$j++;
			}

			if ($inStands == -1)
			{
				//Add the product we are retrieving to the stand.
				$stands[$i]['products'][] = $this->members[$i];
				//If the stand is not in our array, just append it.
				$stands[$i]['stand'] = $stand;
				//Also set the price for ease of use.
				$stands[$i]['totalPrice'] = $this->members[$i]->quantity * $this->members[$i]->price;
			}
			else
			{
				//If the stand is in our array, add the product to it.
				$stands[$inStands]['products'][] = $this->members[$i];
				//Add to the toal price.
				$stands[$inStands]['totalPrice'] += $this->members[$i]->quantity * $this->members[$i]->price;
			}
		}
		return $stands;
	}

	/**
	* Persist this object in the Session.
	*/
	public function persist()
	{
		Session::set('cart', $this);
	}

	/**
	* Remove this object from the Session.
	*/
	public function forget()
	{
		Session::forget('cart');
	}
}