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

// make const number of pagination, to use it with any object when return it.
define('PAGINATION_COUNT', 10);
// Note the instructor mention it's not the good thing

Route::group([ 'namespace'=>'Admin' ,'middleware' => 'auth:admin'] , function() {
    Route::get('/' , 'DashboardController@index')->name('admin.dashboard');

    ################################ Begin Languages Routes #######################################
    Route::group(['prefix' => 'language'], function(){
        Route::get('/' , 'LanguageController@index')->name('admin.languages');
        Route::get('/create' , 'LanguageController@create')->name('admin.languages.create');
        Route::post('/store' , 'LanguageController@store')->name('admin.languages.store');
        Route::get('/edit/{id}' , 'LanguageController@edit')->name('admin.languages.edit');
        Route::post('/update/{id}' , 'LanguageController@update')->name('admin.languages.update');
        Route::get('/delete/{id}' ,'LanguageController@destroy')->name('admin.languages.delete');
    ################################ End Languages Routes #######################################
    });

    ################################ Begin Main Categories Routes #######################################
    Route::group(['prefix' => 'main_category'], function(){
        Route::get('/' , 'MainCategoryController@index')->name('admin.maincategories');
        Route::get('/create' , 'MainCategoryController@create')->name('admin.maincategories.create');
        Route::post('/store' , 'MainCategoryController@store')->name('admin.maincategories.store');
        Route::get('/edit/{id}' , 'MainCategoryController@edit')->name('admin.maincategories.edit');
        Route::post('/update/{id}' , 'MainCategoryController@update')->name('admin.maincategories.update');
        Route::get('/delete/{id}' ,'MainCategoryController@destroy')->name('admin.maincategories.delete');
    ################################ End Main Categories Routes #######################################
    });

    ################################ Begin Vendors Routes #######################################
    Route::group(['prefix' => 'vendors'], function(){
        Route::get('/' , 'vendorsController@index')->name('admin.vendors');
        Route::get('/create' , 'vendorsController@create')->name('admin.vendors.create');
        Route::post('/store' , 'vendorsController@store')->name('admin.vendors.store');
        Route::get('/edit/{id}' , 'vendorsController@edit')->name('admin.vendors.edit');
        Route::post('/update/{id}' , 'vendorsController@update')->name('admin.vendors.update');
        Route::get('/delete/{id}' ,'vendorsController@destroy')->name('admin.vendors.delete');
    ################################ End Vendors Routes #######################################
    });
});




Route::group([ 'namespace'=>'Admin' ,'middleware' => 'guest:admin'] , function() {
    
    Route::get('login' , 'LoginController@getLogin');
    Route::post('login' , 'LoginController@login')->name('admin.login');
});