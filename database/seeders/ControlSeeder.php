<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
    }
}
