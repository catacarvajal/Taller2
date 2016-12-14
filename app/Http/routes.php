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
Route::get('/Grafico/get{variable}', 'chartsController@getGrafico');
Route::get('/Graficos/{tipo}', 'chartsController@nuevaVentana');
Route::post('/cargar', 'chartsController@abrirFile');
Route::post('ajax','chartsController@ajaxGeoJson');
