<?php

namespace App\Services;

use App\Models\MatchGame;
use App\Models\Round;
use App\Models\Team;
use Illuminate\Support\Facades\DB;

class RoundService
{
    public function startQuarterfinals(Round $round)
    {
        abort_if($round->isStarted(), 400, 'As quartas de final já foram iniciadas.');
        abort_if($round->isFinished(), 400, 'As quartas de final foram finalizadas.');
        abort_if(Team::greaterThanEightTeams(),400, 'Não é permitido iniciar a fase com mais de 8 times. Por favor, remova algum time.');
        abort_if(Team::lessThanEightTeams(), 400, 'Não é permitido iniciar a fase com menos de 8 times. Por favor, adicione mais times.');

        $shuffledTeams = Team::all()->shuffle()->all();

        for ($i = 0; $i < Team::count(); $i++) {
            $team = $shuffledTeams[$i];
            $nextTeam = $shuffledTeams[++$i];

            MatchGame::create([
                'round_id' => $round->id,
                'team1_id' => $team->id,
                'team2_id' => $nextTeam->id,
                'match_date' => now()->addDay()->toDateTimeString()
            ]);
        }

        $round->update(['started' => true]);
    }
}
