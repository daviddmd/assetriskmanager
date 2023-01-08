<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssetTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        DB::table('asset_types')->insert([
            'name' => "Router"
        ]);
        //2
        DB::table('asset_types')->insert([
            'name' => "Switch"
        ]);
        //3
        DB::table('asset_types')->insert([
            'name' => "Laptop"
        ]);
        //4
        DB::table('asset_types')->insert([
            'name' => "Server"
        ]);
        //5
        DB::table('asset_types')->insert([
            'name' => "Mainframe"
        ]);
        //6
        DB::table('asset_types')->insert([
            'name' => "IP Camera"
        ]);
        //7
        DB::table('asset_types')->insert([
            'name' => "Analog Camera"
        ]);
        //8
        DB::table('asset_types')->insert([
            'name' => "NVR"
        ]);
        //9
        DB::table('asset_types')->insert([
            'name' => "DVR"
        ]);
        //10
        DB::table('asset_types')->insert([
            'name' => "Desktop"
        ]);
        //11
        DB::table('asset_types')->insert([
            'name' => "Workstation"
        ]);
        //12
        DB::table('asset_types')->insert([
            'name' => "Other"
        ]);
        //13
        DB::table('asset_types')->insert([
            'name' => "NAS"
        ]);
    }
}
