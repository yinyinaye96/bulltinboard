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



Auth::routes();
Route::get('/', 'Post\PostController@showPost')->name('postlist');
Route::get('/home', 'HomeController@index')->name('home');

// user
Route::get('/createuser','User\UserController@createUser')->name('createuser');
Route::post('/userconfirm','User\UserController@userconfirm')->name('userconfirm');
Route::post('/storeuser', 'User\UserController@storeUser')->name('storeuser');
Route::any('/userlist','User\UserController@showUser')->name('userlist');
Route::any('/userlist', 'User\UserController@searchUser')->name('userlist');
Route::get('/delete/{id}','User\UserController@destroy')->name('delete');
Route::get('/profile','User\UserController@profile')->name('profile');
Route::get('/updateuser','User\UserController@updateUser')->name('updateuser');
Route::post('/updateconfirm', 'User\UserController@updateconfirmUser')->name('updateconfirm');
Route::post('/userupdate','User\UserController@userUpdate')->name('userupdate');
Route::get('password-change', 'User\UserController@password');
Route::post('password-change', 'User\UserController@changePassword')->name('password-change');

// post
Route::get('/posts/createpost','Post\PostController@createPost')->name('createpost');
Route::post('/posts/postconfirm','Post\PostController@confirmPost')->name('postconfirm');
Route::post('/posts/storepost','Post\PostController@storePost')->name('storepost');
Route::any('/posts/postlist','Post\PostController@showPost')->name('postlist');
Route::any('/posts/postlist', 'Post\PostController@searchPost')->name('postlist');
Route::get('/posts/delete/{id}','Post\PostController@destroy')->name('delete');
Route::get('/posts/editpost/{id}','Post\PostController@editPost')->name('editpost');
Route::post('/posts/updateconfirm', 'Post\PostController@updateConfirmPost')->name('updateconfirm');
Route::post('/posts/updatepost', 'Post\PostController@update')->name('updatepost');
Route::get('/posts/download', 'Post\PostController@export')->name('download');
Route::get('/posts/uploadpost','Post\PostController@uploadPost')->name('uploadpost');
Route::post('/posts/import', 'Post\PostController@import')->name('import');




