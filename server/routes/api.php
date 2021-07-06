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

$apiVersion = 'v1';

Route::get("/$apiVersion/developers", [DeveloperController::class, 'index']);
Route::post("/$apiVersion/developers", [DeveloperController::class, 'store']);
Route::get("/$apiVersion/developers/{id}", [DeveloperController::class, 'show']);
Route::put("/$apiVersion/developers/{id}", [DeveloperController::class, 'update']);
Route::delete("/$apiVersion/developers/{id}", [DeveloperController::class, 'destroy']);