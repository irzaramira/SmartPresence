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
Route::get('{class_id}/delete', 'ClassController@deleteClass');

Route::get('/class/{class_id}', 'ClassController@view');

Route::get('/addClass', 'ClassController@viewAddClass');
Route::post('/addClass/success', 'ClassController@AddClass');
Route::get('/class/{class_id}/editClass', 'ClassController@viewEditClass');
Route::post('/class/{class_id}/editClass/success', 'ClassController@editClass');

Route::get('/class/{class_id}/addPertemuan', 'PertemuanController@viewAddPertemuan');
Route::post('/class/{class_id}/addPertemuan/success', 'PertemuanController@AddPertemuan');
Route::get('/class/{class_id}/{pertemuan_id}/editPertemuan', 'PertemuanController@viewEditPertemuan');
Route::post('/class/{class_id}/{pertemuan_id}/editPertemuan/success', 'PertemuanController@editPertemuan');
Route::get('/class/{class_id}/{pertemuan_id}/deletePertemuan', 'PertemuanController@deletePertemuan');

