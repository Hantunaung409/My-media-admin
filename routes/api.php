<?php

use App\Http\Controllers\Api\ActionLogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

  Route::post('user/login',[AuthController::class,'login']);
  Route::post('user/register',[AuthController::class,'register']);

  Route::get('allPost',[PostController::class,'allPost']);
  Route::post('post/search',[PostController::class,'postSearch']);
  Route::post('post/details',[PostController::class,'postDetails']);


  Route::get('allCategory',[CategoryController::class,'allCategory']);
  Route::post('category/search',[CategoryController::class,'categorySearch']);

  Route::post('post/actionLog',[ActionLogController::class,'setActionLog']);
