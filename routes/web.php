<?php

use \Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\NewsController;
use \App\Http\Controllers\IndexController;
use \App\Http\Controllers\CategoryController;
use \App\Http\Controllers\FeedbackController;
use \App\Http\Controllers\OrderController;
use \App\Http\Controllers\Account\IndexController as AccountController;
use \App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use \App\Http\Controllers\Admin\NewsController as AdminNewsController;
use \App\Http\Controllers\Admin\SourceController as AdminSourceController;
use \App\Http\Controllers\Admin\UserController as AdminUserController;

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

Route::get('/main', function () {
    return view('welcome');
});


Route::get('/',[IndexController::class, 'index'])->name('index');



// feedback
Route::prefix('feedback')->group(function (){
    Route::get('/', [FeedbackController::class, 'index'])
        ->name('feedback');
    Route::post('/store', [FeedbackController::class, 'store'])
        ->name('feedback.store');
});

// order
Route::prefix('order')->group(function (){
    Route::get('/', [OrderController::class, 'index'])
        ->name('order');
    Route::post('/store', [OrderController::class, 'store'])
        ->name('order.store');
});

//news
Route::group(['as'=>'news.', 'prefix'=>'news'], function (){
    Route::get('/', [NewsController::class, 'index'])
        ->name('index');
    Route::get('/{news}', [NewsController::class, 'show'])
        ->where('news','\d+')
        ->name('show');
    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('categories');
    Route::get('/category/{slug}', [CategoryController::class, 'show'])
        ->name('category');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/account', AccountController::class)
        ->name('account');

    Route::get('/account/logout', function() {
        \Auth::logout();
        return redirect()->route('login');
    })->name('account.logout');

    //admin
    Route::group(['as'=>'admin.', 'prefix' => 'admin', 'middleware' => 'admin'], function (){
        Route::view('/', 'admin.index')->name('index');
        Route::resource('/categories', AdminCategoryController::class);
        Route::resource('/news', AdminNewsController::class);
        Route::resource('/sources', AdminSourceController::class);
        Route::resource('/users', AdminUserController::class);
    });

});


//admin

//Route::get('/account', AccountController::class)->name('account');
////admin
//Route::group(['as'=>'admin.', 'prefix' => 'admin'], function (){
//    Route::view('/', 'admin.index')->name('index');
//    Route::resource('/categories', AdminCategoryController::class);
//    Route::resource('/news', AdminNewsController::class);
//    Route::resource('/sources', AdminSourceController::class);
//});

Route::get('/session', function (){
    if(session()->has('test')) {
        session()->forget('test');
    }
    session(['test'=> rand(1,1000)]);
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
