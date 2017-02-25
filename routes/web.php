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
Route::post('/add-hotel', 'OrderController@addHotelToCart');
Route::get('/package/{uuid}', 'OrderController@showOrder');

/**
 * Hotels
 */
Route::resource('hotels', 'HotelController');

/**
 * Seat Related
 */
Route::get('/seat-data/{uuid}', 'SeatController@getSeatData');

/**
 * Authentication
 */
Auth::routes();

Route::group(['prefix' => 'dashboard', 'middleware' => 'admin'], function () {
    Route::get('/', 'DashboardController@index');
    Route::resource('/price-category', 'PriceCategoryController');
    Route::resource('/seat-map', 'SeatController', ['except' => ['getSeatData']]);
    Route::get('/hotels', 'HotelController@showAll');
    Route::post('/hotels/{id}/edit/add-room', 'HotelController@addRoom');
});
