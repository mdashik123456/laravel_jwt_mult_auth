<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SubAdminController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=> 'admin'], function ($router){  // admin panel route
    Route::post('/login', [AdminController::class, 'login']);   //
    Route::post('/reg', [AdminController::class, 'register']);   //
});

Route::group(['middleware'=>['jwt.role:admin', 'jwt.auth'], 'prefix'=> 'admin'], function ($router){  // admin panel route
    Route::post('/logout', [AdminController::class, 'logout']);   //
    Route::get('/profile', [AdminController::class, 'userProfile']);   //
});

Route::group(['prefix'=> 'subadmin'], function ($router){  // subadmin panel route
    Route::post('/login', [SubAdminController::class, 'login']);   //
    Route::post('/reg', [SubAdminController::class, 'register']);   //
});

Route::group(['middleware'=>['jwt.role:subadmin', 'jwt.auth'], 'prefix'=> 'subadmin'], function ($router){  // admin panel route
    Route::post('/logout', [SubAdminController::class, 'logout']);   //
    Route::get('/profile', [SubAdminController::class, 'userProfile']);   //
});