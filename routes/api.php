<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FlightController;
use App\Http\Controllers\Api\AirplaneController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post("/airplanes", [AirplaneController::class, "store"])->name("apiairplanestore");
Route::get("/airplanes", [AirplaneController::class, "index"])->name("apiairplaneindex");
Route::get("/airplanes/{id}", [AirplaneController::class, "show"])->name("apiairplaneshow");
Route::put("/airplanes/{id}", [AirplaneController::class, "update"])->name("apiairplaneupdate");
Route::delete("/airplanes/{id}", [AirplaneController::class, "destroy"])->name("apiairplanedestroy");

Route::post("/flights", [FlightController::class, "store"])->name("apiflightstore");
Route::get("/flights", [FlightController::class, "index"])->name("apiflightindex");
Route::get("/flights/{id}", [FlightController::class, "show"])->name("apiflightshow");
Route::put("/flights/{id}", [FlightController::class, "update"])->name("apiflightupdate");
Route::delete("/flights/{id}", [FlightController::class, "destroy"])->name("apiflightdestroy");