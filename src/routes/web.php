<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Student\ListController;
use App\Http\Controllers\Student\AddViewController;
use App\Http\Controllers\Student\AddController;

Route::get('/student', ListController::class);
Route::get('/student/add', AddViewController::class);
Route::post('/student/add', AddController::class);