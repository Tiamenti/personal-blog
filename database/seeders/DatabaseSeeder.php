<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\PostCategoryFactory;
use Database\Factories\PostFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        PostCategoryFactory::new()->count(10)->create();
        PostFactory::new()->count(20)->create();
        $this->call(ProductionSeeder::class);
    }
}
