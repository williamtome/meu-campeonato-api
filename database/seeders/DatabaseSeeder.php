<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoundSeeder::class,
        ]);

         User::create([
             'name' => 'José Gustavo',
             'email' => 'jose@teste.com',
             'password' => Hash::make('password'),
         ]);
    }
}
