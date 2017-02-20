<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function (){
    Route::any('login', 'LoginController@login');
    Route::get('codePic', 'LoginController@codePic');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['web', 'admin.login']], function (){
    Route::get('index', 'IndexController@index');
    Route::get('info', 'IndexController@info');
    Route::get('quit', 'IndexController@quit');
    Route::any('upload', 'ArticleController@upload');
    Route::resource('category', 'CategoryController');
    Route::resource('article', 'ArticleController');
    Route::resource('links', 'LinksController');
    Route::resource('navigation', 'NavigationController');
    Route::resource('config', 'ConfigController');
});

Route::group(['prefix' => '/', 'namespace' => 'Home'], function (){
    Route::get('', 'IndexController@index');
    Route::get('category/{cate_id}', 'IndexController@category');
    Route::get('article/{art_id}', 'IndexController@article');
    Route::get('about', 'IndexController@about');
    Route::get('time', 'IndexController@time');
});

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

//Route::get('/', function () {
//    return view('welcome');
//});
