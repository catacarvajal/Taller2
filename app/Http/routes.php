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
Route::get('/', 'HomeController@index'); 
Route::get('/Grafico', 'chartsController@index'); 
Route::get('/MapaYGrafico', 'HomeController@indexAmbos');
Route::post('/Grafico', 'chartsController@postGrafico');
Route::get('/Graficos/{tipo}', 'chartsController@nuevaVentana');

Route::post('ajax','chartsController@ajaxGeoJson');

Route::post('/datos','chartsController@datosRegion');
Route::get('/region/{region}','HomeController@getProvincias');
Route::get('/provincia/{provincia}','HomeController@getComunas');
Route::get('/comuna/{comuna}','HomeController@getGeom');
Route::get('/Graficos/{periodo}/{escenario}/{region}/{provincia}/{comuna}', 'chartsController@datos');
