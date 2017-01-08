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

Route::get('/', 'PagesController@home');

Route::get('books', 'BooksController@index');
Route::get('books/{book}', 'BooksController@show');
Route::get('books/{book}/edit', 'BooksController@edit');
Route::patch('books/{book}/', 'BooksController@update');

Route::get('sellers', 'SellersController@index');
Route::get('sellers/{seller}', 'SellersController@show');
Route::post('sellers/{seller}/books', 'SellersController@addBook');
Route::post('sellers', 'SellersController@addSeller');
