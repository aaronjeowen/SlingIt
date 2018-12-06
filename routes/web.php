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

Route::get('/','PagesController@getHome');
Route::get('/test','PagesController@getTest');
Route::get('/home','PagesController@getHome');
Route::get('/welcome','PagesController@getWelcome');
Route::get('/explore','ArticleController@getArticlesView');
Route::get('/post/{post}','ArticleController@getArticlePost');
Route::get('/submit','PagesController@getSubmit');
Route::get('/profile/{userprofile}','UserController@getUserProfile');
Route::get('/user/{id}','UserController@getUser');
Route::post('/profile/{userprofile}/submit','UserController@editProfile');
Route::post('/submit/submit','ArticleController@submit');
Route::post('/explore/submit','ViewController@submit');
Route::post('/post/submit','CommentsController@submit');
Route::post('/post/download','CommentsController@download');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::post('/search/submit','SearchController@submit');
Route::post('/profile/submit','UserController@submit');


Auth::routes();
