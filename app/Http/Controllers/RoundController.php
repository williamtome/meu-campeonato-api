<?php

namespace App\Http\Controllers;

use App\Models\Round;
use App\Services\RoundService;

class RoundController extends Controller
{
    public function __construct(private RoundService $roundService)
    { }

    public function start(int $roundId)
    {
        $round = Round::findOrFail($roundId);

        $roundFunctionName = $round->getRoundFunctionName();

        $this->roundService->$roundFunctionName($round);

        return response()->json([
            'message' => 'Etapa das qurtas de final iniciada com sucesso.'
        ]);
    }
}
