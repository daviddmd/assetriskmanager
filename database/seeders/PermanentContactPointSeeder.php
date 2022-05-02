<?php

namespace Database\Seeders;

use App\Models\PermanentContactPoint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
