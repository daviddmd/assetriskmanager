<?php

namespace Database\Seeders;

use App\Models\SecurityOfficer;
use Illuminate\Database\Seeder;

class SecurityOfficerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SecurityOfficer::factory()->count(1)->create();
    }
}
