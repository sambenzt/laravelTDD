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

Route::get('/', function () {
    return view('welcome');
});


Route::post('/books','BooksController@store');
Route::put('/books/{book}','BooksController@update');
Route::delete('/books/{book}','BooksController@destroy');

Route::post('/authors','AuthorsController@store');

Route::post('/checkout/{book}','CheckoutController@store');
Route::post('/checkin/{book}','CheckinController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
