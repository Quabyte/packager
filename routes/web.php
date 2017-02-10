<?php
Route::get('/', 'ApplicationController@index');

/**
 * Venue Related
 */
Route::get('/load-venue', 'ApplicationController@loadVenue');
Route::get('/get-data/{fileName}', 'ApplicationController@getData');

/**
 * Order and Package
 */
Route::post('/add-to-cart', 'OrderController@addToCart');
Route::get('/package/{uuid}', 'OrderController@showOrder');

/**
 * Hotels
 */
Route::resource('hotels', 'HotelController');

/**
 * Authentication
 */
Auth::routes();
