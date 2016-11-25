<?php

namespace App;

use Illuminate\Foundation\Auth\User;

use Illuminate\Database\Eloquent\articles;

class NewArticle extends articles extends User
{
    protected $fillable = []
    	'name','content',
    ];

}
