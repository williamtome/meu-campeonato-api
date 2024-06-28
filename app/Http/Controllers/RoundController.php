<?php

namespace App\Http\Controllers;

use App\Models\Round;
use App\Services\MatchGameService;
use App\Services\RoundService;
use Illuminate\Support\Facades\DB;

class RoundController extends Controller
{
    public function __construct(
        private RoundService $roundService,
        private MatchGameService $matchGameService
    ) { }

    public function matches(int $roundId)
    {
        $round = Round::findOrFail($roundId);

        return response()->json($round->matches);
    }

    public function start(int $roundId)
    {
        $round = Round::findOrFail($roundId);

        $roundFunctionName = $round->getRoundFunctionName();

        $this->roundService->$roundFunctionName($round);

        return response()->json([
            'message' => 'Etapa das qurtas de final iniciada com sucesso.'
        ]);
    }

    public function simulate(int $roundId)
    {
        $round = Round::findOrFail($roundId);

        DB::beginTransaction();

        try {
            foreach ($round->matches as $match) {
                $this->matchGameService->simulate($match);
            }

            $round->update(['finished' => true]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return response()->json(['message' => 'Simulação das partidas da(s) ' . $round->name . ' finalizadas com sucesso.']);
    }
}
