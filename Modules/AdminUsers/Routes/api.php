<?php

use Modules\AdminUsers\Http\Controllers\Settings\PermissionsSettingsController;
use Modules\AdminUsers\Http\Controllers\Settings\RolesSettingsController;
use Modules\AdminUsers\Http\Controllers\Settings\UserSettingsController;

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

Route::group(['middleware' => ['auth:api', 'role:admin'], 'prefix' => 'admin/settings'], function () {
    Route::apiResource('users', UserSettingsController::class);
    Route::post('users/restore', [UserSettingsController::class, 'restore']);
    Route::apiResource('permissions', PermissionsSettingsController::class)->only('index', 'show');
    Route::apiResource('roles', RolesSettingsController::class)->only('index', 'show', 'update');
});
