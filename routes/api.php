<?php

use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware(['api'])->prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, "index"]);
    Route::post('/create', [CategoryController::class, "store"]);
    Route::get('/{id}', [CategoryController::class, "show"]);
    Route::get('/delete/{id}', [CategoryController::class, "destroy"]);
    Route::post('/{id}', [CategoryController::class, "edit"]);
});

Route::middleware(['api'])->prefix('tag')->group(function () {
    Route::get('/', [TagController::class, "index"]);
    Route::post('/create', [TagController::class, "store"]);
    Route::get('/{id}', [TagController::class, "show"]);
    Route::get('/delete/{id}', [TagController::class, "destroy"]);
    Route::post('/{id}', [TagController::class, "edit"]);
});

Route::middleware(['api'])->prefix('advertisement')->group(function () {
    Route::get('/filter', [AdvertisementController::class, "filter"]);
});
