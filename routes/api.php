<?php

use App\Http\Controllers\RoundController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::apiResource('teams', TeamController::class);

Route::post('/rounds/{id}/start', [RoundController::class, 'start']);
