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
//Auth::routes();
Route::post('/login', 'LoginCtrl@validateLogin');


//admin page
Route::get('admin','admin\HomeCtrl@index');

Route::match(["GET","POST"],'admin/profiles/{requestName}','admin\ProfileCtrl@index');
Route::get('admin/upload/{requestName}','admin\ProfileCtrl@upload');
Route::get('admin/upload','admin\ProfileCtrl@index');
Route::post('admin/upload','admin\ProfileCtrl@uploadData');
Route::get('admin/upload/result','admin\ProfileCtrl@uploadResult');

Route::match(['GET','POST'],'admin/profiles/create/{requestName}','admin\ProfileCtrl@create');
Route::post('admin/profiles/store/{requestName}','admin\ProfileCtrl@store');

Route::match(["GET","POST"],'admin/profiles/update/{id}/{requestName}','admin\ProfileCtrl@edit');

//params
Route::get('location/muncity/{province_id}','ParamCtrl@getMuncity');
Route::get('param/age/{dob}','ParamCtrl@getAge');

Route::post('admin/verify','admin\ProfileCtrl@verify');
Route::post('admin/remove/{requestName}','admin\ProfileCtrl@remove');
Route::post('admin/refuse/{requestName}','admin\ProfileCtrl@refuse');
Route::match(['GET','POST'],'getStaticAge','admin\ProfileCtrl@getStaticAge');
Route::post('getAge','admin\ProfileCtrl@getStaticAge');

//API OPO
Route::match(['GET','POST'],'api','ApiCtrl@api');

Route::get('importExport', 'MaatwebsiteController@importExport');
// Route for export/download tabledata to .csv, .xls or .xlsx
Route::get('downloadExcel/{type}', 'MaatwebsiteController@downloadExcel');
// Route for import excel data to database.
Route::post('importExcel/{municipality}', 'MaatwebsiteController@importExcel');

// DENGVAXIA
Route::match(["GET","POST"],'admin/dengvaxia_list/{muncity}','DengvaxiaController@dengvaxia');
Route::post('delete_dengvaxia','DengvaxiaController@delete_dengvaxia');


//Route::post('importExcel/{municipality}', 'MaatwebsiteController@upload2');

Route::get('add_user',function(){
    \DB::table('users')->insert([
        'username' => 'user',
        'password' => bcrypt('secret'),
        'level' => 'user',
    ]);
});
