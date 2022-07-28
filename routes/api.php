<?php

use App\Http\Controllers\Admin\ManageAssetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider with  in a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('/user', ManageUserController::class);
Route::resource('/asset', ManageAssetController::class);
Route::post('/login', [AuthenticationController::class, 'index']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/user-information', [AuthenticationController::class, 'userInformation']);
    Route::get('/logout', [AuthenticationController::class, 'logout']);
    Route::resource('/profile', ProfileController::class);
    Route::get('/manageUser', [ManageUserController::class, 'manageUser']);
});
