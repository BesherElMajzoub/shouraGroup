<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            SettingsSeeder::class,
            StatsSeeder::class,
            ServicesSeeder::class,
            ClientsSeeder::class,
            TimelineNodesSeeder::class,
            BranchesSeeder::class,
            SectorsSeeder::class,
            BrandsSeeder::class, // must run after SectorsSeeder — links brands to sectors
            CategoriesSeeder::class,
            ProjectsSeeder::class,
            NewsSeeder::class,
        ]);
    }
}
