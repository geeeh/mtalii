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
// auth
Auth::routes();

// Home pages
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', 'HomeController@about');
Route::get('/event', 'HomeController@events')->name('events');

// Events routes
Route::post('/event/search', 'HomeController@searchEvents');
Route::post('/event/{event_id}/send', 'HomeController@sendRequests');
Route::post('/event/{event_id}/create', 'InterestController@create');
Route::get('/event/{event_id}/show', 'EventController@show');
Route::post('/companies/{company_id}/event', 'EventController@store');
Route::put('/companies/{company_id}/event/{event_id}/update', 'EventController@update')->name('updateEvent');
Route::delete('/companies/{company_id}/event/{event_id}/delete', 'EventController@destroy')->name('deleteEvent');

// Company routes
Route::resource('companies', 'CompanyController');

// Google login routes
Route::get('/redirect', 'Auth\LoginController@redirectToProvider');
Route::get('/callback', 'Auth\LoginController@handleProviderCallback');

// BucketList routes
Route::resource('bucketlist', 'BucketlistController');

// Dashboard routes
Route::get('/dashboard/index', 'DashboardController@index');
Route::get('/statscount', 'DashboardController@getCompanyAndUserCount');
Route::get('/account/delete', 'DashboardController@deleteAccount')->name('deleteAccount');

