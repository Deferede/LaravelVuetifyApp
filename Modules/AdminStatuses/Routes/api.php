<?php

use Modules\AdminStatuses\Http\Controllers\StatusCategoryController;
use Modules\AdminStatuses\Http\Controllers\StatusController;
use Modules\AdminStatuses\Http\Controllers\StatusTypeController;

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

Route::group(['middleware' => 'auth:api', 'prefix' => 'admin'], function () {
    Route::apiResource('statuses', StatusController::class);
    Route::apiResource('status/types', StatusTypeController::class);
    Route::apiResource('status/categories', StatusCategoryController::class);
});
