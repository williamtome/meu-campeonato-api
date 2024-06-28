<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Round extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public const QUARTER_FINALS = 1;
    public const SEMIFINAL = 2;
    public const FINAL = 3;

    public function getRoundFunctionName(): string
    {
        $rounds = [
            self::QUARTER_FINALS => 'startQuarterfinals',
            self::SEMIFINAL => 'startSemifinal',
            self::FINAL => 'startFinal',
        ];

        return data_get($rounds, $this->id);
    }

    public function matches(): HasMany
    {
        return $this->hasMany(MatchGame::class)
            ->with([
                'team1',
                'team2',
                'result.winner',
                'result.loser'
            ]);
    }

    public function isStarted(): bool
    {
        return (bool) $this->started;
    }

    public function isFinished(): bool
    {
        return (bool) $this->finished;
    }
}
