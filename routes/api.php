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

    });
    // Province Section
    Route::prefix('provincias')->group(function(){
        Route::post('agregar-provincia', 'App\Http\Controllers\ProvinceController@store');
        Route::get('mostrar-detalle-provincia/{province}', 'App\Http\Controllers\ProvinceController@show');
        Route::get('mostrar-provincia/{province}/edit', 'App\Http\Controllers\ProvinceController@edit');
        Route::get('todas-provincias', 'App\Http\Controllers\ProvinceController@index');
        Route::put('editar-provincia/{province}', 'App\Http\Controllers\ProvinceController@update');
        Route::delete('eliminar-provincia/{province}', 'App\Http\Controllers\ProvinceController@destroy');
    });
    //City Section
    Route::prefix('ciudades')->group(function(){
        Route::post('agregar-ciudad', 'App\Http\Controllers\CityController@store');
        Route::get('mostrar-detalle-ciudad/{ciudad}', 'App\Http\Controllers\CityController@show');
        Route::get('mostrar-ciudad/{ciudad}/edit', 'App\Http\Controllers\CityController@edit');
        Route::get('todas-ciudades', 'App\Http\Controllers\CityController@index');
        Route::put('editar-ciudad/{ciudad}', 'App\Http\Controllers\CityController@update');
        Route::delete('eliminar-ciudad/{ciudad}', 'App\Http\Controllers\CityController@destroy');
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
