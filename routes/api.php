<?php

use App\Http\Controllers\Auth\MeController;
use App\Http\Controllers\Settings\PermissionsSettingsController;
use App\Http\Controllers\Settings\RolesSettingsController;
use App\Http\Controllers\Settings\UserSettingsController;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['middleware' => ['api'], 'prefix' => 'auth'], function () {
//    Route::post('register', 'register');
    Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
//    Route::post('logout', 'AuthController@logout');
//    Route::post('refresh', 'AuthController@refresh');
});
//

Route::group(['middleware' => ['auth:api'], 'prefix' => 'auth'], function () {
    Route::post('me', [MeController::class, 'me']);
    Route::post('hasPermissionTo', [MeController::class, 'hasPermissionTo']);
});
