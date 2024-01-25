<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('api')->prefix('v1')->group(function () {

    // Auth Section
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('profile', 'App\Http\Controllers\AuthController@profile');
    Route::post('register', 'App\Http\Controllers\AuthController@register');

    // Establishment Section
    Route::prefix('establecimientos')->group(function () {
        Route::post('agregar-establecimiento', 'App\Http\Controllers\EstablishmentController@createEsteblishment');
        // Agrega más rutas relacionadas con establecimientos aquí si es necesario
    });

});


// Route::group([

//     'middleware' => 'api',
//     'prefix' => 'v1'

// ], function ($router) {

//     // Auth Section
//     Route::post('login', 'App\Http\Controllers\AuthController@login');
//     Route::post('logout', 'App\Http\Controllers\AuthController@logout');
//     Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
//     Route::post('profile', 'App\Http\Controllers\AuthController@profile');
//     Route::post('register', 'App\Http\Controllers\AuthController@register');

//     // Establishment Section
//     Route::post('establecimientos/agregar-establecimiento', 'App\Http\Controllers\EstablishmentController@createEsteblishment');

// });
