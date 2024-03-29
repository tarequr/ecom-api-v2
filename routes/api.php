<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\AuthenticationController;
use App\Http\Controllers\API\BrandController;
use App\Http\Controllers\API\SubCategoryController;
use App\Http\Controllers\API\UnitController;

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

Route::post("/v2/login", [AuthenticationController::class, 'login']);

Route::group(['prefix' => 'v2', 'middleware' => ['auth:sanctum']], function() {
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('sub-categories', SubCategoryController::class);
    Route::apiResource('brands', BrandController::class);
    Route::apiResource('units', UnitController::class);
});
