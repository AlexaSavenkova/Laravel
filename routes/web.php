<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\NewsController;
use \App\Http\Controllers\IndexController;
use \App\Http\Controllers\CategoryController;
use \App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use \App\Http\Controllers\Admin\NewsController as AdminNewsController;

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

//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('/',[IndexController::class, 'index'])->name('index');

//news
Route::group(['as'=>'admin.', 'prefix' => 'admin'], function (){
    Route::view('/', 'admin.index')->name('index');
    Route::resource('/categories', AdminCategoryController::class);
    Route::resource('/news', AdminNewsController::class);
});

Route::get('/news', [NewsController::class, 'index'])
    ->name('news.index');
Route::get('news/{id}', [NewsController::class, 'show'])
    ->where('id','\d+')
    ->name('news.show');
Route::get('news/categories', [CategoryController::class, 'index'])
    ->name('news.categories');
Route::get('news/category/{slug}', [CategoryController::class, 'show'])
    ->name('news.category');
