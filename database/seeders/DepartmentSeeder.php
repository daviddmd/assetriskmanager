<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'name' => "Human Resources",
            'description' => "Human Resources.\nLocated in Building 2",
        ]);
        DB::table('departments')->insert([
            'name' => "Financial Department",
            'description' => "Financial Department.\nLocated in Building 3",
        ]);
        DB::table('departments')->insert([
            'name' => "Secret Resources",
            'description' => "Department for classified Operations.\nLocation Unknown.",
        ]);
        DB::table('departments')->insert([
            'name' => "Public Relations",
            'description' => "Department for Public Relations.\nMostly Remote.",
        ]);
        DB::table('departments')->insert([
            'name' => "Administration",
            'description' => "Department for Administrative Matters.\nBuilding 4, Floor 12.",
        ]);
    }
}
