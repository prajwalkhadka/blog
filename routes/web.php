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
use App\Http\Middleware\CheckAdmin;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

// social login
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
// Route::view('/admin','admin.dashboard');
// Route::view('/about','about');
// Route::view('/about','about');


Route::middleware(['verified'])->prefix('admin')->group(function() {

Route::post('post','PostController@store')->name('post.store');
Route::get('post/create','PostController@create')->name('post.create');
Route::get('post/index','PostController@index')->name('post.index');
Route::get('post/edit/{id}','PostController@edit')->name('post.edit');
Route::get('post/show/{id}','PostController@show')->name('post.show');
Route::post('post/update/{id}','PostController@update')->name('post.update');
Route::delete('post/delete/{id}','PostController@destroy')->name('post.delete');
Route::resource('category','CategoryController');

});

Route::get('/admin', 'AdminController@index')->name('admin')->middleware('verified','checkadmin');