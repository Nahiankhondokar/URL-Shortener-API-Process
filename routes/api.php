<?php

use App\Http\Controllers\API\v1\AuthController;
use App\Http\Controllers\API\v1\ShortUrlController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/v1/login', [AuthController::class, 'login']);
Route::post('/v1/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->prefix('v1')->group(function(){
    Route::get('/users', [AuthController::class, 'index']);
    Route::post('/short-url', [ShortUrlController::class, 'shortUrl']);
});