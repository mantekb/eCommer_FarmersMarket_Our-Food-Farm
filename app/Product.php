<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function stand()
    {
    	return $this->belongsToMany(Stand::class, 'stand_products')
    		->withTimestamps();	
    }
}
