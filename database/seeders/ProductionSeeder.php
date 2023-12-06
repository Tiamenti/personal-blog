<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Orchid\Platform\Models\Role;

class ProductionSeeder extends Seeder
{
    public function run(): void
    {
        Role::create([
            'slug' => 'moderator',
            'name' => 'Moderator',
            'permissions' => [
                'posts.edit' => 1,
                'platform.index' => 1,
            ],
        ]);
    }
}
