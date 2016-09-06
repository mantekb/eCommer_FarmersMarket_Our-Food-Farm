<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('learning', function() {
	//Replace function with a controller function instead.
	$articles = [
		[
			'title' => 'Tomatoes',
			'excerpt' => 'something somethings',
			'author' => 'Farmer'
		],
		[
			'title' => 'Corn',
			'excerpt' => 'something somethings',
			'author' => 'Stand Owner'
		],
	];
	return view('learning.learning-resources', ['articles' => $articles]);
});
