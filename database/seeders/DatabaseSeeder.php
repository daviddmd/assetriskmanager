<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AssetTypeSeeder::class,
            DepartmentSeeder::class,
            PermanentContactPointSeeder::class,
            SecurityOfficerSeeder::class,
            ThreatSeeder::class,
            ControlSeeder::class,
            ControlThreatSeeder::class,
            UserSeeder::class,
            AssetSeeder::class
        ]);
    }
}
