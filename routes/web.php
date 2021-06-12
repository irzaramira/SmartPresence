<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/Profile', 'UserController@viewProfile');
Route::get('/editProfile', 'UserController@viewEditProfile');
Route::post('/editProfile/success', 'UserController@editProfile');
Route::get('/changePassword', 'UserController@viewChangePassword');
Route::post('/changePassword/success', 'UserController@changePassword');
Route::get('/forbidden', 'HomeController@viewForbidden');


Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::post('/userregistered/{role}/add/success', 'UserController@addUser');

    Route::get('/userregistered/dosen', 'HomeController@viewDosen');
    Route::get('/userregistered/dosen/{user_id}/delete', 'UserController@deleteDosen');

    Route::get('/userregistered/mahasiswa', 'HomeController@viewMahasiswa');
    Route::get('/userregistered/mahasiswa/{user_id}/delete', 'UserController@deleteMahasiswa');

    Route::get('/classregistered', 'HomeController@viewClass');
    Route::get('/classregistered/{user_id}/{class_id}/pertemuanregistered/', 'HomeController@viewPertemuan');
});

Route::group(['middleware' => ['auth', 'role:mahasiswa,dosen']], function () {
    Route::get('/allclass', 'HomeController@viewAllClass');
    Route::get('/class/{class_id}', 'ClassController@view');
    Route::get('/allclass/search', 'HomeController@searchClass');
});

Route::group(['middleware' => ['auth', 'role:mahasiswa']], function () {
    Route::post('/{class_id}/enroll', 'HomeController@enrollClass');
    Route::get('/class/{class_id}/unenroll', 'HomeController@unenrollClass');
    Route::post('/class/{class_id}/{pertemuan_id}/checked', 'AbsenController@addAbsen');
});

Route::group(['middleware' => ['auth', 'role:dosen']], function () {
    Route::get('{class_id}/delete', 'ClassController@deleteClass');

    Route::get('/addClass', 'ClassController@viewAddClass');
    Route::post('/addClass/success', 'ClassController@AddClass');
    Route::get('/class/{class_id}/editClass', 'ClassController@viewEditClass');
    Route::post('/class/{class_id}/editClass/success', 'ClassController@editClass');

    Route::get('/class/{class_id}/addPertemuan', 'PertemuanController@viewAddPertemuan');
    Route::post('/class/{class_id}/addPertemuan/success', 'PertemuanController@AddPertemuan');
    Route::get('/class/{class_id}/{pertemuan_id}/editPertemuan', 'PertemuanController@viewEditPertemuan');
    Route::post('/class/{class_id}/{pertemuan_id}/editPertemuan/success', 'PertemuanController@editPertemuan');
    Route::get('/class/{class_id}/{pertemuan_id}/deletePertemuan', 'PertemuanController@deletePertemuan');

    Route::get('/class/{class_id}/{pertemuan_id}/{absen_id}/delete', 'AbsenController@deleteAbsen');
});