<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class newarticlecontroller extends Controller
{
    public function NewArticle()
    {
    	return view('learning.newarticle');
    }}
