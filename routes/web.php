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

Route::get('/', 'HomeController@index');
Route::get('/single-post/{id}', 'HomeController@singlePost');
Route::get('/home/search', 'HomeController@search');
Route::get('/category/{category}/{id}', 'HomeController@categoryWiseView');



Auth::routes();

Route::get('abc', 'HomeController@something');

Route::get('archive/{year}/{month}', 'HomeController@searchByArchive');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/hello', function () {
    return 'world';
});

Route::get('/jquery-practice', function () {
    return view('jquery-practice');

});

Route::get('/jquery-practice2', function () {
    return view('jquery-p2');
});

Route::group(['middleware' => ['auth']], function () {

    //});


    Route::group(['middleware' => 'must_be_admin'], function () {

        Route::get('category/index', 'CategoryController@index');
        Route::get('category/create', 'CategoryController@create');
        Route::get('category/{id}/edit', 'CategoryController@edit');
        Route::post('category/{id}/update', 'CategoryController@update');
        Route::get('category/{id}/view', 'CategoryController@view');
        Route::post('category/store', 'CategoryController@store');
        Route::get('category/{id}/delete', 'CategoryController@delete');
        Route::post('category/store/{id}', 'CategoryController@update');

        Route::get('category/ajax-search', 'CategoryController@ajaxSearch');

        //Route::get('user-management/index', 'UserManagementController@index')->middleware('must_be_admin');
        Route::get('user-management/index', 'UserManagementController@index');

        //Route::group(['middleware' => 'must_be_admin'], function () {
        Route::get('user-management/create', 'UserManagementController@create');
        Route::get('user-management/{id}/edit', 'UserManagementController@edit');
        Route::post('user-management/{id}/update', 'UserManagementController@update');
        Route::get('user-management/{id}/view', 'UserManagementController@view');
        Route::post('user-management/store', 'UserManagementController@store');
        Route::get('user-management/{id}/delete', 'UserManagementController@delete');
        Route::post('user-management/store/{id}', 'UserManagementController@update');
        Route::get('user-management/search', 'UserManagementController@search');
    });

    Route::group(['middleware' => ['web']], function () {
        Route::get('post/index', 'PostController@index');
        Route::get('post/create', 'PostController@create');
        Route::get('post/{id}/edit', 'PostController@edit');
        Route::post('post/{id}/update', 'PostController@update');
        Route::get('post/{id}/view', 'PostController@view');
        Route::post('post/store', 'PostController@store');
        Route::get('post/{id}/delete', 'PostController@delete');
        Route::post('post/store/{id}', 'PostController@update');
        Route::get('post/search', 'PostController@search');





        Route::get('post/ajax-practice', function () {
            return view("ajax-practice.index");
        });

        Route::get('post/get-details', 'PostController@getDetails');

        Route::get('post/search', 'PostController@searchForm');
        Route::get('post/ajax-search', 'PostController@ajaxSearch');
    });


});

