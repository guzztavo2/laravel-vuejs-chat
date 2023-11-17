<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::middleware(["auth"])->group(function () {
    Route::get("/", [App\Http\Controllers\ChatsController::class, "index"]);
    Route::get("/messages", [App\Http\Controllers\ChatsController::class, "fetchMessages"]);
    Route::post("/user-typing", [App\Http\Controllers\ChatsController::class, "userTyping"]);
    Route::post("/messages", [App\Http\Controllers\ChatsController::class, "sendMessage"]);
    Route::get("/home", [App\Http\Controllers\HomeController::class, "index"])->name("home");
});