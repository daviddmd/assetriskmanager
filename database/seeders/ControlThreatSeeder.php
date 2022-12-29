<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ControlThreatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('control_threat')->insert([
            'threat_id' => 1,
            'control_id' => 5,
        ]);
        DB::table('control_threat')->insert([
            'threat_id' => 2,
            'control_id' => 5,
        ]);
        DB::table('control_threat')->insert([
            'threat_id' => 3,
            'control_id' => 2,
        ]);
        DB::table('control_threat')->insert([
            'threat_id' => 3,
            'control_id' => 4,
        ]);
        DB::table('control_threat')->insert([
            'threat_id' => 4,
            'control_id' => 2,
        ]);
        DB::table('control_threat')->insert([
            'threat_id' => 4,
            'control_id' => 3,
        ]);
        DB::table('control_threat')->insert([
            'threat_id' => 4,
            'control_id' => 4,
        ]);
        DB::table('control_threat')->insert([
            'threat_id' => 5,
            'control_id' => 7,
        ]);
        DB::table('control_threat')->insert([
            'threat_id' => 5,
            'control_id' => 6,
        ]);
        DB::table('control_threat')->insert([
            'threat_id' => 8,
            'control_id' => 1,
        ]);
    }
}
