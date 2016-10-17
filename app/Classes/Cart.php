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
	* 
	*
	* @
	*/
	public function add($product, $quantity)
	{
		$product->quantity = $quantity;
		//See if the product is in the cart
		$isFound = false;
		$i = 0;
		$numMembers = count($this->members);
		while ($i < $numMembers && !$isFound)
		{
			if ($this->members[$i]->id == $product->id)
			{
				//Increment Quantity for Producct
				$isFound = true;
				$this->members[$i]->quantity += $quantity;
			}
			$i++;
		}
		if (!$isFound)
		{
			$this->members[] = $product;
		}
	}
}