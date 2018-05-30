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

Route::match(['POST','GET'],'/','HomeCtrl@index');

Route::get('/logout', function (){
    Session::flush();
    return redirect('login');
});
Route::get('/login', 'LoginCtrl@login');
Route::post('/login', 'LoginCtrl@validateLogin');


//admin page
Route::get('admin','admin\HomeCtrl@index');

Route::match(["GET","POST"],'admin/profiles/{requestName}','admin\ProfileCtrl@index');
Route::get('admin/profiles/upload','admin\ProfileCtrl@upload');
Route::post('admin/profiles/upload','admin\ProfileCtrl@uploadData');

Route::match(['GET','POST'],'admin/profiles/create/{requestName}','admin\ProfileCtrl@create');
Route::post('admin/profiles/store/{requestName}','admin\ProfileCtrl@store');

Route::match(["GET","POST"],'admin/profiles/update/{id}/{requestName}','admin\ProfileCtrl@edit');

//params
Route::get('location/muncity/{province_id}','ParamCtrl@getMuncity');
Route::get('param/age/{dob}','ParamCtrl@getAge');

Route::post('admin/verify','admin\ProfileCtrl@verify');
Route::post('admin/remove/{requestName}','admin\ProfileCtrl@remove');
Route::post('admin/refuse/{requestName}','admin\ProfileCtrl@refuse');

//API OPO
Route::get('pendingApi','ApiCtrl@pendingApi');

