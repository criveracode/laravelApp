<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
         \App\Models\User::factory()->create();
         \App\Models\Post::factory(80)->create();
        
    }
}

/**
 * php artisan migrate:refresh --seed
 */