<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\StandAddress;

class Stand extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    /**
    * Creates the Stand with all the data required.
    *
    * @param $data - Data from post request
    */
    public function createFromForm($data, User $user)
    {
        $this->user_id      = $user->id;
        $this->name         = $data['name'];
        $this->description  = $data['description'];
        $this->save();
        //Now save the address to it's table.
        $address = new StandAddress;
        $address->stand_id     = $this->id;
        $address->address      = $data['address'];
        $address->city         = $data['city'];
        $address->state        = $data['state'];
        $address->zip          = $data['zip'];
        //These aren't "required" so if they don't exist, we just put blank.
        $address->lat          = (isset($data['lat'])  ? $data['lat']  : '');
        $address->long         = (isset($data['long']) ? $data['long'] : '');
        $address->save();
    }

    public function address()
    {
        return $this->hasOne('App\StandAddress');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'stand_products')
            ->withTimestamps();
    }

    public function hasProducts()
    {
        return (bool)count($this->products);
    }

    public function addProduct(Product $product)
    {
        $this->products()->attach($product->id);
    }

    public function removeProduct(Product $product)
    {
        $this->products()->detach($product->id);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
