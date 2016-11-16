<?php 

namespace App\Classes;

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
		}
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
}