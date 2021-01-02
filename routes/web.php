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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'HomeController@index')->name('home');

Route::get('/class/{class_id}', 'ClassController@view');

Route::get('/addClass', 'ClassController@viewAddClass');
Route::post('/addClass/success', 'ClassController@AddClass');
Route::get('/class/{class_id}/editClass', 'ClassController@viewEditClass');
Route::post('/class/{class_id}/editClass/success', 'ClassController@editClass');

Route::get('/class/{class_id}/addPertemuan', 'PertemuanController@viewAddPertemuan');
Route::post('/class/{class_id}/addPertemuan/success', 'PertemuanController@AddPertemuan');
Route::get('/class/{class_id}/editPertemuan/{pertemuan_id}', 'ClassController@viewEditClass');
Route::post('/class/{class_id}/editPertemuan/{pertemuan_id}/success', 'ClassController@editClass');
