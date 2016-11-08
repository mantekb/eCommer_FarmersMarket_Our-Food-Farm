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

Route::get('/', ['as' => '/', 'uses' => 'LandingController@index']);
Route::get('/home', ['as' => '/home', 'uses' =>'HomeController@index']);

Route::get('/navbar', ['as' => '/navbar',
	'uses' => function() {
	return view('components.navbar');
	}
]);

Route::auth();

Route::group(['prefix' => '/stand'], function() {
	//Use middleware to ensure you can only make a stand if you are logged in.
	Route::match(['get', 'post'], '/create', ['as' => '/create', 'uses' => 'StandController@create'])->middleware('onestand');
	Route::match(['get', 'post'], '/edit', 'StandController@edit')->middleware('hasstand');
	Route::match(['get', 'post'], '/products', 'StandController@products')->middleware('hasstand');
	//This has to go last, otherwise other routes try to be a {Stand}
	Route::get('/{stand}', ['as' => '/{stand}', 'uses' => 'StandController@view']);
});

Route::group(['prefix' => '/cart'], function() {
	Route::post('/add/{product}', 'CartController@add');
	Route::post('/remove/{product}', 'CartController@remove');
	Route::post('/update', 'CartController@update');
	Route::get('/view', 'CartController@view');
	Route::get('/getTotals', 'CartController@getTotalQuantityAndPrice');
});

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

Route::group(['prefix'=>'/settings', 'middleware'=>'auth'], function() {
	Route::get('/', ['as' => '/', 'uses' => 'SettingsController@index']);
	Route::post('/name', 'SettingsController@changeName');
	Route::post('/password', 'SettingsController@changePassword');
	Route::post('/address', 'SettingsController@changeAddress');
	Route::post('/removeStand', 'SettingsController@removeStand');
});

Route::group(['prefix' => '/location'], function() {
	Route::post('/get-lat-long', 'LocationController@getCoords');
	Route::post('/save', 'LocationController@saveGeoLocation');
});

Route::get("/deals", "ShoppingController@deals");


Route::get("/article", "ArticleController@article");

Route::group(['prefix'=>'/payment', 'middleware'=>'auth'], function() {
	Route::get('/', ['as' => '/', 'uses' => 'PaymentController@PaymentInfo']);
	Route::post('/createStripeAccount', 'PaymentController@createStripeAccount');
});


//Routes to error pages below
Route::get('/404', function() {
	return view('errors.not-found');
});


// This is for testing, remove once testing complete
Route::get('/session/flush', function() {
	Session::flush();
});