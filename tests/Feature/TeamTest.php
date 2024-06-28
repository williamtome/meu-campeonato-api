<?php

namespace Tests\Feature;

use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeamTest extends TestCase
{
    use RefreshDatabase;

    public function test_should_be_list_all_the_teams_registered(): void
    {
        $response = $this->get('/api/teams');

        $response->assertStatus(200);
    }

    public function test_should_be_return_team_created_when_register_new_team(): void
    {
        $response = $this->post('/api/teams', [
            'name' => 'Araraquara FC',
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            "name" => 'Araraquara FC',
        ]);
    }

    public function test_should_be_return_team_updated_when_team_is_edited(): void
    {
        $team = Team::factory()->create();

        $response = $this->put('/api/teams/'.$team->id, [
            'name' => 'Araraquara Editado FC',
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            "name" => 'Araraquara Editado FC',
        ]);
    }

    public function test_should_be_return_void_when_team_is_deleted(): void
    {
        $team = Team::factory()->create();

        $response = $this->delete('/api/teams/'.$team->id);

        $response->assertStatus(200);

        $this->assertNull(Team::find($team->id));
    }
}
