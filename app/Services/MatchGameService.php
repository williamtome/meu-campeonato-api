<?php

namespace App\Services;

use App\Models\MatchGame;
use App\Models\Result;
use App\Models\Team;

class MatchGameService
{
    public function simulate(MatchGame $match): void
    {
        $team1Goals = random_int(0, 5);
        $team2Goals = random_int(0, 5);

        [$winner, $loser] = $this->determineWinnerAndLoser($match, $team1Goals, $team2Goals);

        $this->updateTeamPoints($winner, $loser, $team1Goals, $team2Goals);

        $this->saveMatchResult($match, $winner, $loser, $team1Goals, $team2Goals);
    }

    private function determineWinnerAndLoser(MatchGame $match, int $team1Goals, int $team2Goals): array
    {
        if ($team1Goals == $team2Goals) {
            return $this->resolveTie($match, $team1Goals, $team2Goals);
        }

        return $team1Goals > $team2Goals
            ? [$match->team1, $match->team2]
            : [$match->team2, $match->team1];
    }

    private function resolveTie(MatchGame $match, int $team1Goals, int $team2Goals): array
    {
        $team1 = $match->team1;
        $team2 = $match->team2;

        $team1Points = $team1->points + abs($team1Goals - $team2Goals);
        $team2Points = $team2->points + abs($team2Goals - $team1Goals);

        if ($team1Points == $team2Points) {
            return $team1->registered_at < $team2->registered_at
                ? [$team1, $team2]
                : [$team2, $team1];
        }

        return $team1Points > $team2Points
            ? [$team1, $team2]
            : [$team2, $team1];
    }

    private function updateTeamPoints(Team $winner, Team $loser, int $team1Goals, int $team2Goals): void
    {
        $winner->points += ($team1Goals + $team2Goals);
        $loser->points -= ($team1Goals + $team2Goals);
        $winner->save();
        $loser->save();
    }

    private function saveMatchResult(MatchGame $match, Team $winner, Team $loser, int $team1Goals, int $team2Goals): void
    {
        Result::create([
            'match_id' => $match->id,
            'winner_id' => $winner->id,
            'loser_id' => $loser->id,
            'team1_goals' => $team1Goals,
            'team2_goals' => $team2Goals,
        ]);
    }
}
