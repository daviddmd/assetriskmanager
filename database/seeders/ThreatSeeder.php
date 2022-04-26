<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThreatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('threats')->insert([
            'name' => "RCE",
            'description' => "Remote Code Execution",
        ]);
        DB::table('threats')->insert([
            'name' => "LPE",
            'description' => "Local Privilege Escalation",
        ]);
        DB::table('threats')->insert([
            'name' => "XSS",
            'description' => "Cross-Site Scripting",
        ]);
        DB::table('threats')->insert([
            'name' => "SQLi",
            'description' => "SQL Injection",
        ]);
        DB::table('threats')->insert([
            'name' => "Theft",
            'description' => "Robbery to Physical Premises",
        ]);
        DB::table('threats')->insert([
            'name' => "Fire",
            'description' => "Fire in any of the Buildings",
        ]);
        DB::table('threats')->insert([
            'name' => "Flooding",
            'description' => "Flooding in any of the base floors.",
        ]);
        DB::table('threats')->insert([
            'name' => "Unauthorized AD Access",
            'description' => "Unauthorized ActiveDirectory access in the intranet",
        ]);
    }
}
