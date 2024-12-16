<?php

use Illuminate\Support\Facades\Route;

Route::prefix('band')->group(function(){
Route::get('', 'BandController@index');
Route::post('', 'BandController@create');
Route::get('/{id}', 'BandController@show');
Route::get('/{id}', 'BandController@update');
Route::get('/{id}', 'BandController@delete');
});