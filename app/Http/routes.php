<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|

*/
$app->get('/', ['as'=>'home',function(){
	return view('default');
}
   
]);

$app->post('/',['as'=>'getURL','uses'=>'MainController@Simulate_CQ_Bai']);
//$app->post('/',['as'=>'getURL','uses'=>'MainController@bet_simulation']);
/*
Route::get('/', array('as' => 'home', function()
{
    return View::make('main');
}));

*/