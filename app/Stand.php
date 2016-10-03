<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

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
        $this->address      = $data['address'];
        $this->city         = $data['city'];
        $this->state        = $data['state'];
        $this->zip          = $data['zip'];
        $this->save();
    }
}
