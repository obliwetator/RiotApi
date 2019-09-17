<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@home');
Route::get('/test', 'PagesController@test');

Route::get('/summoner', 'PagesController@summoner');
Route::get('/summoner/champions', 'PagesController@summonerChampions');

Route::get('/champions','PagesController@champions');
// Dynamic path for each champion
Route::get('/champions/{name}/statistics', 'PagesController@championsStat');

Route::get('/stats','PagesController@stats');

Route::get('/leaderboards','PagesController@leaderboards');




Route::get('/statistics', function(){
	return view('statistics');
});


Route::get('/getRequest', function(){
	if(Request::ajax()){
		return 'getReuqest has been loaded';
	}
});

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/test', function ()
{
    return view('test');
});

