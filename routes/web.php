<?php
Route::get('/', 'ApplicationController@index');
Route::get('/package', 'ApplicationController@package');
Route::get('/load-venue', 'ApplicationController@loadVenue');
Route::get('/get-data/{fileName}', 'ApplicationController@getData');
Route::resource('hotels', 'HotelController');
Auth::routes();
