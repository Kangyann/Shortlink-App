<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Kangyann',
            'username' => 'Kangyann',
            'email' => 'dianstore00@gmail.com',
            'password' => bcrypt(123321),
            'api_key' => Str::random(32),
        ]);
    }
}
