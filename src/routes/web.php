<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Student\AddViewController;
use App\Http\Controllers\Student\AddController;

Route::get('/student/add', AddViewController::class);
Route::post('/student/add', AddController::class);