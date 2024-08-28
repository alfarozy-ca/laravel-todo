<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\todoController;

Route::get('/test', function () {
    return "Test";
});
Route::get('/hello', function () {
    return "Hello gaisss";
});
// routes/api.php
Route::apiResource('todos', TodoController::class);

// Sanctum
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

 // Rate limited routes