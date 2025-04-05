<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Student\ListController;
use App\Http\Controllers\Student\AddViewController;
use App\Http\Controllers\Student\AddController;

Route::prefix('student')->group(function () {
    // 一覧画面
    Route::get('/', ListController::class)->name(ListController::class);

    // 登録画面
    Route::get('/add', AddViewController::class)->name(AddViewController::class);
    Route::post('/add', AddController::class)->name(AddController::class);
});