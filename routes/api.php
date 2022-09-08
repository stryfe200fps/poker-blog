<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\LiveReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('article', ArticleController::class);
Route::resource('live-report', LiveReportController::class);
