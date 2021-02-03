<?php

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

Route::get('/',  'CompanyController@index');
Route::get('/pdf',  'PDFController@index');
Route::post('/ajax_upload/action', 'PDFController@action')->name('ajaxupload.action');
