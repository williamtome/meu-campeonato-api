<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'points',
        'registered_at'
    ];

    public function matchesTeam1(): HasMany
    {
        return $this->hasMany(MatchGame::class, 'team1_id');
    }

    public function matchesTeam2(): HasMany
    {
        return $this->hasMany(MatchGame::class, 'team2_id');
    }

    public function wins(): HasMany
    {
        return $this->hasMany(Result::class, 'winner_id');
    }

    public function losses(): HasMany
    {
        return $this->hasMany(Result::class, 'loser_id');
    }
}
