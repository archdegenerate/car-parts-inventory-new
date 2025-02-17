<?php
use App\Http\Controllers\CarController;
use App\Http\Controllers\PartController;
use Illuminate\Support\Facades\Route;

Route::apiResource('cars', CarController::class);
Route::apiResource('parts', PartController::class);
