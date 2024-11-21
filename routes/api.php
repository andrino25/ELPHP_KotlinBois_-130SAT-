<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpiderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::patch('/user/edit', [AuthController::class, 'editProfile'])->middleware('auth:sanctum');
Route::post('/user/forgot-password', [AuthController::class, 'forgotPassword']);
Route::get('/user/notifications', [AuthController::class, 'getNotifications'])->middleware('auth:sanctum');

Route::apiResource('spiders', SpiderController::class)->middleware('auth:sanctum');
Route::get('/catalogs', [CatalogController::class, 'index']);
Route::get('/catalogs/{catalog}', [CatalogController::class, 'show']);
