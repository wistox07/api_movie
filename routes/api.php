<?php

use App\Http\Controllers\AuthController;
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
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

//Route::post('register', 'AuthController@register');
//Route::post('login', 'AuthController@login');
//Route::middleware('auth:api')->post('logout', 'AuthController@logout');


//Route::get('/login', [AuthController::class, "login"]);
/*
Route::prefix('/auth')->middleware(['auth', 'admin'])->group(function () {
    // Rutas dentro del grupo "admin"
    Route::get('login', 'AdminController@dashboard')->name('admin.dashboard');
    Route::get('users', 'AdminController@users')->name('admin.users');
    Route::get('settings', 'AdminController@settings')->name('admin.settings');
});
*/

Route::prefix('/auth')->group(function () {
    // Rutas dentro del grupo "admin"
    Route::post('login', [AuthController::class, "login"]);
    Route::post('logout', [AuthController::class, "logout"]);
    Route::post('register',[AuthController::class, "register"]);
});

