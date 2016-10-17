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
	public function add($product)
	{
		$this->members[] = $product;
	}
}