<?php

use App\Http\Middleware\Cors;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeveloperController;

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

Route::middleware([Cors::class])->group(function () {
    Route::get('/developers', [DeveloperController::class, 'index']);
    Route::post('/developers', [DeveloperController::class, 'store']);
    Route::get('/developers/{id}', [DeveloperController::class, 'show']);
    Route::put('/developers/{id}', [DeveloperController::class, 'update']);
    Route::delete('/developers/{id}', [DeveloperController::class, 'destroy']);
});