<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FuelController;

Route::get('/fuel', [FuelController::class, 'index']);
Route::post('/fuel', [FuelController::class, 'store']);
Route::delete('/fuel/{id}', [FuelController::class, 'destroy']);
