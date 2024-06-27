<?php

namespace Database\Seeders;

use App\Models\Round;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoundSeeder extends Seeder
{
    public function run(): void
    {
        $rounds = [
            [
                'name' => 'Quartas de Final',
            ],
            [
                'name' => 'Semifinal',
            ],
            [
                'name' => 'Final',
            ],
        ];

        foreach ($rounds as $round) {
            Round::create($round);
        }
    }
}
