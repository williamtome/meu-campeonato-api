<?php

use App\Http\Controllers\MatchGameController;
use App\Http\Controllers\RoundController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::apiResource('teams', TeamController::class);

Route::prefix('/rounds')->group(function () {
    Route::post('/{id}/start', [RoundController::class, 'start']);
    Route::get('/{id}/matches', [RoundController::class, 'matches']);
    Route::post('/{id}/matches/simulate', [RoundController::class, 'simulate']);
});
