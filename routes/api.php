<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post("/airplanes", [AirplaneController::class, "store"])->name("apiairplanestore");
Route::get("/airplanes", [AirplaneController::class, "index"])->name("apiairplaneindex");
Route::get("/airplanes/{id}", [AirplaneController::class, "show"])->name("apiairplaneshow");
Route::put("/airplanes/{id}", [AirplaneController::class, "update"])->name("apiairplaneupdate");
Route::delete("/airplanes/{id}", [AirplaneController::class, "destroy"])->name("apiairplanedestroy");