<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TrendPostController;

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

Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    //admin
    Route::get('/dashboard',[ProfileController::class,'index'])->name('dashboard');
    //admin profile edit
    Route::post('/profile/edit',[ProfileController::class,'profileEdit'])->name('admin@profileEdit');
    //admin password changing page
    Route::get('/change/passwordPage',[ProfileController::class,'changePasswordPage'])->name('admin@changePasswordPage');
    //admin password changing
    Route::post('/change/password',[ProfileController::class,'changePassword'])->name('admin@changePassword');

    //admin list
    Route::get('admin/list',[ListController::class,'index'])->name('admin@listPage');
    //delete admin list
    Route::get('admin/list/delete/{id}',[ListController::class,'delete'])->name('admin@listDelete');
    //serach
    // Route::post('admin/list/search',[ListController::class,'listSearch'])->name('admin@listSearch');
    Route::get('admin/list/search',[ListController::class,'listSearch'])->name('admin@listSearch');

    //admin category
    Route::get('admin/category',[CategoryController::class,'index'])->name('admin@categoryPage');
    Route::post('admin/category/create',[CategoryController::class,'create'])->name('category@create');
    Route::get('admin/category/ajax/delete',[CategoryController::class,'delete'])->name('category@ajaxDelete');
    Route::get('admin/category/delete/{id}',[CategoryController::class,'delete'])->name('category@delete');
    Route::get('admin/category/editPage/{id}',[CategoryController::class,'editPage'])->name('category@editPage');
    Route::post('admin/category/update',[CategoryController::class,'update'])->name('category@update');

    //admin post
    Route::get('admin/post',[PostController::class,'index'])->name('admin@postPage');
    Route::post('admin/post/create',[PostController::class,'create'])->name('post@create');
    Route::get('admin/post/delete/{id}',[PostController::class,'delete'])->name('post@delete');
    Route::get('admin/post/edit/{id}',[PostController::class,'editPage'])->name('post@editPage');
    Route::post('admin/post/edit',[PostController::class,'edit'])->name('post@edit');


    //admin trend post
    Route::get('admin/trendPost',[TrendPostController::class,'index'])->name('admin@trendPostPage');
    Route::get('admin/trendPost/details/{id}',[TrendPostController::class,'trendPostDetails'])->name('admin@trendPostDetails');

});
