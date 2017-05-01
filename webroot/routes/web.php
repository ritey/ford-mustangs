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

Route::get('/',['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('/mustang-gallery',['as' => 'gallery', 'uses' => 'HomeController@gallery']);
Route::get('/mustang-gallery/{id}',['as' => 'gallery.item', 'uses' => 'HomeController@galleryItem']);
Route::get('/blog',['as' => 'blog', 'uses' => 'BlogController@index']);
Route::get('/contact',['as' => 'contact', 'uses' => 'HomeController@contact']);
Route::post('/contact',['as' => 'contact.send', 'uses' => 'HomeController@contactSend']);