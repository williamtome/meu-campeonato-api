<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'match_id',
        'winner_id',
        'loser_id',
        'team1_goals',
        'team2_goals',
    ];

    public function match(): BelongsTo
    {
        return $this->belongsTo(MatchGame::class);
    }

    public function winner(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'winner_id');
    }

    public function loser(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'loser_id');
    }
}
