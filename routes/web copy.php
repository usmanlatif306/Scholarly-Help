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

load_route('installer');
load_route('website');


// Route::get('/cache-clear', 'CommandController@cache');
// Route::get('/config-clear', 'CommandController@config');
// Route::get('/route-cache', 'CommandController@route');
// Route::get('/route-clear', 'CommandController@routeClear');
// Route::get('/storage-link', 'CommandController@storage');

// google auth
Route::get('authorized/google', 'Auth\GoogleController@redirectToGoogle')->name('google_login');
Route::get('authorized/google/callback', 'Auth\GoogleController@handleGoogleCallback');
// FaceBook Auth
Route::get('auth/facebook', 'Auth\FacebookController@redirectToFacebook')->name('facebook_login');
Route::get('auth/facebook/callback', 'Auth\FacebookController@handleFacebookCallback');


Route::post('additional/services', 'ServiceController@getAdditionalServicesByServiceId')
    ->name('additional_services_by_service_id');

Route::post('services/sub_categories', 'SubCategoryController@getSubCategoriesByServiceId')
    ->name('sub_categories_by_service_id');

Route::get('writer/apply', 'ApplicantController@create')
    ->name('writer_application_page');

Route::post('writer/apply', 'ApplicantController@store')
    ->name('store_writer_application');

// Route::post('cart/login', 'CartController@storeOrderInSessionWithoutLogin')
//     ->name('add_to_cart_login');
Route::post('cart/add', 'CartController@storeOrderInSession')
    ->name('add_to_cart');
// Route::post('marketing/email', 'CartController@storeEmailForMeketing')
//     ->name('email_marketing');


Auth::routes(['verify' => true]);

Route::post('attachments/upload', 'AttachmentController@upload')
    ->name('order_upload_attachment');
// Authenticated Users
Route::group(['middleware' => ['auth', 'verified']], function () {

    // Generic Routes (Admin and Staffs, both)
    load_route('generic');

    // For Admin Only
    Route::group(['middleware' => ['role:admin']], function () {
        load_route('admin');
    });
    // End of Admin only

    // For Staff Only
    Route::group(['middleware' => ['role:staff']], function () {
        load_route('staff');
    });
    // End of Staff Only


    // Admin and staff
    Route::group(['middleware' => ['role:admin|staff']], function () {

        Route::get('tasks', 'TaskController@index')->name('tasks_list');
        Route::post('/tasks/datatable/', 'TaskController@datatable')->name('tasks_datatable');
        Route::post('task/submit/{order}', 'TaskController@submit_work')->name('submit_work');
        Route::post('task/start/{order}', 'TaskController@start_working')->name('start_working');
    });
    // End of Admin and staff


});
