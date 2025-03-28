<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\FlightController;
use App\Http\Controllers\Api\AirplaneController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/me', [AuthController::class, 'me'])-> middleware('auth:api')->name('me');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
});

Route::post("/airplanes", [AirplaneController::class, "store"])->name("apiairplanestore");
Route::get("/airplanes", [AirplaneController::class, "index"])->name("apiairplaneall");
Route::get("/airplanes/{id}", [AirplaneController::class, "show"])->name("apiairplaneshow");
Route::put("/airplanes/{id}", [AirplaneController::class, "update"])->name("apiairplaneupdate");
Route::delete("/airplanes/{id}", [AirplaneController::class, "destroy"])->name("apiairplanedestroy");

Route::post("/flights", [FlightController::class, "store"])->name("apiflightstore");
Route::get("/flights", [FlightController::class, "index"])->name("apiflightall");
Route::get("/flights/{id}", [FlightController::class, "show"])->name("apiflightshow");
Route::put("/flights/{id}", [FlightController::class, "update"])->name("apiflightupdate");
Route::delete("/flights/{id}", [FlightController::class, "destroy"])->name("apiflightdestroy");