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


// main category
Route::get('admin/maincategory/list','MaincategoryController@index')->name('mainCategoryList');
Route::get('admin/maincategory/create','MaincategoryController@create')->name('mainCategoryCreate');
Route::post('admin/maincategory/create','MaincategoryController@store')->name('mainCategoryStore');
Route::post('admin/maincategory/update/{id}','MaincategoryController@update')->name('mainCategoryUpdate');
Route::get('admin/maincategory/delete/{id}','MaincategoryController@destroy')->name('mainCategoryDelete');

// Sub category
Route::get('admin/subcategory/list','SubcategoryController@index')->name('subCategoryList');
Route::get('admin/subcategory/create','SubcategoryController@create')->name('subCategoryCreate');
Route::post('admin/subcategory/create','SubcategoryController@store')->name('subCategoryStore');
Route::post('admin/subcategory/update/{id}','SubcategoryController@update')->name('subCategoryUpdate');
Route::get('admin/subcategory/delete/{id}','SubcategoryController@destroy')->name('subCategoryDelete');

// Tag
Route::get('admin/tag/list','TagController@index')->name('tagList');
Route::get('admin/tag/create','TagController@create')->name('tagCreate');
Route::post('admin/tag/create','TagController@store')->name('tagStore');
Route::post('admin/tag/update/{id}','TagController@update')->name('tagUpdate');
Route::get('admin/tag/delete/{id}','TagController@destroy')->name('tagDelete');

// Song
Route::get('admin/song/list','SongController@index')->name('songList');
Route::get('admin/song/create','SongController@create')->name('songCreate');
Route::post('admin/song/create','SongController@store')->name('songStore');
Route::get('admin/song/edit/{id}','SongController@edit')->name('songEdit');
Route::post('admin/song/update/{id}','SongController@update')->name('songUpdate');
Route::get('admin/song/delete/{id}','SongController@destroy')->name('songDelete');