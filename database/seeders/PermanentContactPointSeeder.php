<?php

namespace Database\Seeders;

use App\Models\PermanentContactPoint;
use Illuminate\Database\Seeder;

class PermanentContactPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PermanentContactPoint::factory()->count(5)->create();
    }
}
