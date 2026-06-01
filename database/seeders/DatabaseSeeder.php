<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     * Menjalankan seeder untuk data makanan dan query evaluasi.
     */
    public function run(): void
    {
        $this->call([
            FoodSeeder::class,
            EvaluationQuerySeeder::class,
        ]);
    }
}
