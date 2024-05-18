<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

Route::post('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::apiResource('defect', \App\Http\Controllers\Api\DefectController::class)->middleware('auth:sanctum');

Route::apiResource('production', \App\Http\Controllers\Api\ResultProductionController::class)->middleware('auth:sanctum');

Route::apiResource('product', \App\Http\Controllers\Api\ProductController::class)->middleware('auth:sanctum');