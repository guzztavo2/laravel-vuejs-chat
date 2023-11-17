<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::middleware(["auth:api"])->put("user/{user}/online", [App\Http\Controllers\UserOnlineController::class, "index"]);
Route::middleware(["auth:api"])->put("user/{user}/offline", [App\Http\Controllers\UserOfflineController::class, "index"]);