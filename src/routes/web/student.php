<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Student\ListController;
use App\Http\Controllers\Student\AddViewController;
use App\Http\Controllers\Student\AddController;

Route::prefix('student')->group(function () {
    Route::get('/', ListController::class)->name(ListController::class);

    Route::get('/add', AddViewController::class)->name(AddViewController::class);

    Route::post('/', AddController::class)->name(AddController::class);
});