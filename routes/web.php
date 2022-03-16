<?php
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('index',CategoryController::class);

Route::post('saveBook',[CategoryController::class,'saveBook']); 

Route::get('indexBook','App\Http\Controllers\BookController@index'); 

Route::get('edit/{id}',[CategoryController::class,'edit2']);

Route::get('destroy/{id}',[CategoryController::class,'destroy']);

Route::delete('delete/{id}',[CategoryController::class,'delete']);






