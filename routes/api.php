<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// fetching order subject's tutor
Route::get('writers/fetch', 'Api\GeneralController@fetchWriters');
Route::post('writers', 'Api\GeneralController@apiWriters');
Route::post('services', 'Api\GeneralController@services');

// create order route
Route::post('order/create', 'Api\CartController@storeOrder');
Route::post('order/status', 'Api\CartController@changeOrderStatus');
Route::post('order/rating', 'Api\CartController@orderRating');
Route::post('order/comment', 'Api\CartController@comments');
