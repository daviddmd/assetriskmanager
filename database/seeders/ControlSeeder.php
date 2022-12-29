<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ControlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('controls')->insert([
            'name' => "Password Reset",
            'description' => "Forced Password Reset Policy every 30 days.",
        ]);
        DB::table('controls')->insert([
            'name' => "Input Sanitization",
            'description' => "Sanitize every user input on the frontend (escape).",
        ]);
        DB::table('controls')->insert([
            'name' => "SQL Prepared Statements",
            'description' => "Migrate from concatenated SQL queries to prepared sql statements.",
        ]);
        DB::table('controls')->insert([
            'name' => "ORM",
            'description' => "Upgrade the platform's SQL queries to use an ORM.",
        ]);
        DB::table('controls')->insert([
            'name' => "Antivirus",
            'description' => "Install AV/Antimalware software.",
        ]);
        DB::table('controls')->insert([
            'name' => "Install Video Cameras",
            'description' => "Install an array of video cameras on multiple buildings connected to a NVR.",
        ]);
        DB::table('controls')->insert([
            'name' => "Install Movement Detectors",
            'description' => "Install movement detectors on all doors that are armed and disarmed at specific hours of the day.",
        ]);
    }
}
