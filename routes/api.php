<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieController;

use App\Models\Movie;
use App\Models\Profile;
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


Route::get('/test', [AuthController::class, "test"]);
/*
Route::prefix('/auth')->middleware(['auth', 'admin'])->group(function () {
    // Rutas dentro del grupo "admin"
    Route::get('login', 'AdminController@dashboard')->name('admin.dashboard');
    Route::get('users', 'AdminController@users')->name('admin.users');
    Route::get('settings', 'AdminController@settings')->name('admin.settings');
});
*/
/*
Route::prefix('/auth')->group(function () {
    // Rutas dentro del grupo "admin"
    Route::post('login', [AuthController::class, "login"]);
    Route::post('logout', [AuthController::class, "logout"]);
    Route::post('register',[AuthController::class, "register"]);
});
*/
Route::group([
    //'middleware' => ['auth_token:except=registera'],
    'prefix' => '/auth'
], function () {
    //Route::post('deserialize', [AuthController::class, "deserialize"]);
    Route::post('login', [AuthController::class, "login"]);
    Route::post('logout', [AuthController::class, "logout"])->middleware('auth_token');
});

Route::post('register',[AuthController::class, "register"]);   

Route::get('logeed/profiles',[ProfileController::class, "getProfilesForToken"]);   




//Route::apiResource('profile', ProfileController::class)->middleware("api");
/*
Route::group([
    'middleware' => 'token',
    'prefix' => '/profile'
], function ($router) {
    //Route::post('deserialize', [AuthController::class, "deserialize"]);
    Route::post('login', [ProfileController::class, "chooseProfile"]);
});
*/

/*
Route::group([
    'middleware' => 'auth_token',
    'prefix' => '/profile'
], function ($router) {
    //Route::post('deserialize', [AuthController::class, "deserialize"]);
    Route::get('me', [ProfileController::class, "me"]);
})
*/;


//Route::apiResource('profile', ProfileController::class)->middleware('auth_token');
Route::apiResource('movie', MovieController::class);

