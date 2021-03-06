<?php

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

Route::get('/', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/about', function () {
    return view('about');
});

/*
Route::get('/events', function () {
    return view('events');
});*/

Route::get('/events', 'App\Http\Controllers\FourtuneEventsController@getEvents');

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/services', function () {
    return view('services');
});