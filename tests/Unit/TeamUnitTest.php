<?php

namespace Tests\Unit;

use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeamUnitTest extends TestCase
{
    use RefreshDatabase;

    public function test_should_be_return_true_if_teams_total_is_greater_than_eight(): void
    {
        Team::factory()->count(9)->create();

        $this->assertTrue(Team::greaterThanEightTeams());
    }

    public function test_should_be_return_true_if_teams_total_is_less_than_eight(): void
    {
        Team::factory()->count(7)->create();

        $this->assertTrue(Team::lessThanEightTeams());
    }
}
