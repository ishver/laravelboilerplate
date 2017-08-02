<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['namespace' => 'API\V1', 'prefix' => 'v1','as' => 'v1.'], function () {

	Route::group(['namespace' => 'Auth'], function () {

		Route::post('register', 'LoginController@register');
		Route::post('login', 'LoginController@login');

		Route::group(['middleware' => 'jwt.auth'], function () 
		{
		    Route::get('user', 'LoginController@getAuthUser');
		});
	});


	// All route names are prefixed with 'api.access'.
	 
	Route::group([
	    'prefix'     => 'access',
	    'as'         => 'access.',
	    'namespace'  => 'Access',
	    'middleware' => 'jwt.auth'
	], function () 
	{
		// Routes for USer API
		Route::resource('user', 'UserController');
	});

});
