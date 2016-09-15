<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Stand extends Model
{
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
