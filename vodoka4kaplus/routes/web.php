<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::middleware('auth')->group(function(){
    Route::get('/', 'MainController@index')->name('index');
    Route::get('/api/countBills/filter/{id}', 'MainController@filter');
    Route::get('/api/countBills/filter_null/', 'MainController@filter_null');
    Route::post('/countBills', 'MainController@countBills');
    Route::get('/api/months/get', 'MainController@months_get');

    Route::get('/api/month_costs', 'MainController@month_costs')->name('month_costs');
    Route::post('/api/month_costs/check', 'MainController@month_costs_check');

    Route::get('/api/pump_meter_records', 'MainController@pump_meter_records')->name('pump_meter_records');
    Route::post('/api/pump_meter_records/check', 'MainController@pump_meter_records_check');

    Route::get('/residents', 'ResidentsController@main')->name('residents.main');
    Route::get('/api/residents', 'ResidentsController@index')->name('residents.index');
    Route::get('/api/residents/{id}', 'ResidentsController@show')->name('residents.show');
    Route::put('/api/residents/{id}', 'ResidentsController@update')->name('residents.update');
    Route::post('/api/residents/create', 'ResidentsController@create')->name('residents.create');
    Route::delete('/api/residents/{id}', 'ResidentsController@destroy')->name('residents.destroy');

    Route::get('/api/bills/{id}', 'BillsController@show')->name('bills.show');

    Route::get('/logout', 'AuthController@logout');
    Route::get('/api/user', 'AuthController@getName');

    //Route::get('/home', 'HomeController@index')->name('home');
});

Auth::routes();


Route::get('{view}', 'MainController@index')->where('view', '(.*)');