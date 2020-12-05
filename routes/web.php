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

Auth::routes();
Route::view('/home', 'home')->middleware('auth');

// Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin', 'namespace' => 'Admin', 'name' => 'admin.'], function () {

Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::post('/login/admin', 'Auth\LoginController@adminLogin');

Route::group(['prefix' => 'admin/translations', 'middleware' => 'auth:admin'], function () {
	Route::get('/{group?}', '\Barryvdh\TranslationManager\Controller@getindex');
	Route::get('/view/{group?}', '\Barryvdh\TranslationManager\Controller@getView');
	Route::post('/edit/{group}', '\Barryvdh\TranslationManager\Controller@postEdit');
	Route::post('/import', '\Barryvdh\TranslationManager\Controller@postImport');
	Route::post('/find', '\Barryvdh\TranslationManager\Controller@postFind');
	Route::post('/publish/{group}', '\Barryvdh\TranslationManager\Controller@postPublish');
	Route::post('/add/{group}', '\Barryvdh\TranslationManager\Controller@postAdd');
	Route::post('/delete/{group}/{key}', '\Barryvdh\TranslationManager\Controller@postDelete');
});

Route::namespace ('Admin')->prefix('admin')->group(function () {
	Route::get('/', 'AdminController@index')->middleware('auth:admin');
	Route::post('language', 'AdminController@language')->middleware('auth:admin')->name('language');
	Route::resource('category', 'CategoryController')->middleware('auth:admin');
	Route::resource('subCategory', 'SubCategoryController')->middleware('auth:admin');
	Route::resource('subSubCategory', 'subSubCategoryContraller')->middleware('auth:admin');
	Route::resource('brand', 'BrandController')->middleware('auth:admin');
});