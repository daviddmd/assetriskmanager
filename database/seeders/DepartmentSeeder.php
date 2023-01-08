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
        //1
        DB::table('departments')->insert([
            'name' => "Research and Development",
            'description' => "R&D.\nBuilding 1",
        ]);
        //2
        DB::table('departments')->insert([
            'name' => "Human Resources",
            'description' => "Human Resources.\nBuilding 2, Floor 1",
        ]);
        //3
        DB::table('departments')->insert([
            'name' => "Marketing and Sales",
            'description' => "Department for Marketing and Sales.\nBuilding 2, Floor 2",
        ]);
        //4
        DB::table('departments')->insert([
            'name' => "Accounting and Finance",
            'description' => "Financial Department.\nBuilding 2, Floor 3",
        ]);
        //5
        DB::table('departments')->insert([
            'name' => "Administration",
            'description' => "Department for Administrative Matters.\nBuilding 2, Floor 4.",
        ]);
        //6
        DB::table('departments')->insert([
            'name' => "Customer Service",
            'description' => "Human Resources.\nBuilding 2, Floor 5",
        ]);
        //7
        DB::table('departments')->insert([
            'name' => "Technology and Development",
            'description' => "Software and Hardware Development.\nRemote/Building 2, Floor 6",
        ]);
        //8
        DB::table('departments')->insert([
            'name' => "QA",
            'description' => "Quality Assurance.\nRemote/Building 2, Floor 6",
        ]);
        //9
        DB::table('departments')->insert([
            'name' => "Legal",
            'description' => "Department for Legal Matters.\nBuilding 2, Floor 7",
        ]);
        //10
        DB::table('departments')->insert([
            'name' => "Information Security",
            'description' => "Building 2, Floor 6",
        ]);
        //11
        DB::table('departments')->insert([
            'name' => "Operations/Production",
            'description' => "Building 3",
        ]);
    }
}
