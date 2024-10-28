<?php

use App\Http\Controllers\API\v2\VisitorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/{url}',[VisitorController::class, 'visitorCount']);