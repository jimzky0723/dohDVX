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

Route::get('/','HomeCtrl@index');

Route::get('/logout', function (){
    Session::flush();
    return redirect('login');
});
Route::get('/login', 'LoginCtrl@login');
Route::post('/login', 'LoginCtrl@validateLogin');


//admin page
Route::get('admin','admin\HomeCtrl@index');

Route::get('admin/profiles','admin\ProfileCtrl@index');
Route::get('admin/profiles/upload','admin\ProfileCtrl@upload');
Route::post('admin/profiles/upload','admin\ProfileCtrl@uploadData');

Route::get('admin/profiles/create','admin\ProfileCtrl@create');
Route::post('admin/profiles/store','admin\ProfileCtrl@store');

Route::get('admin/profiles/update/{id}','admin\ProfileCtrl@edit');

//params
Route::get('location/muncity/{province_id}','ParamCtrl@getMuncity');
Route::get('param/age/{dob}','ParamCtrl@getAge');

