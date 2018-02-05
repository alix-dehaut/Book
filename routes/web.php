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

Route::get('/', 'FrontController@index')->name('home');

Route::get('book/{id}', 'FrontController@show')->where(['id'=>'[0-9]+']);

Route::get('author/{id}', 'FrontController@showBookByAuthor')->where(['id'=>'[0-9]+']);

Route::get('genre/{id}', 'FrontController@showBookByGenre')->where(['id'=>'[0-9]+']);

Route::post('vote', 'FrontController@create')->name('vote');

Route::resource('admin/book', 'BookController')->middleware('auth');

//Route::resource('book/{id}', 'BookController@show')->middleware('auth');

/*
Route::get('/', function () {
    return view('welcome');
});


Route::get('books', function(){
	return App\Book::all();
});

Route::get('book/{id}', function($id){
	return App\Book::find($id);
});
*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
