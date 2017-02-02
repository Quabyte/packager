<?php
Route::get('/', 'ApplicationController@index');
Route::get('/package', 'ApplicationController@package');
Route::resource('hotels', 'HotelController');
Auth::routes();
