<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function items()
    {
    	return $this->hasMany('App\OrderItems');
    }

    public function hasItems()
    {
    	return (bool)count($this->items);
    }

    /** JUST LIKE THE CART FUNCTION
	* Get the total quantity of all items in the order.
	*
	* @return $totalQuant
	*/
	public function getTotalQuantity()
	{
		$totalQuant = 0;
		// Using a foreach here because it passes by value, not reference.
		foreach ($this->items as $product) {
			$totalQuant += $product->quantity;
		}
		return $totalQuant;
	}

	/** JUST LIKE THE CART FUNCTION
	* Calculate the total price of all items in order.
	*
	* @return $totalPrice
	*/
	public function getTotalPrice()
	{
		$totalPrice = 0;
		foreach ($this->items as $product) {
			$totalPrice += $product->quantity * $product->price;
		}
		return number_format($totalPrice, 2);
	}
}
