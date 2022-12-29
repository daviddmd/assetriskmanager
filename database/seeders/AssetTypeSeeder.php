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
        DB::table('asset_types')->insert([
            'name' => "Router"
        ]);
        DB::table('asset_types')->insert([
            'name' => "Switch"
        ]);
        DB::table('asset_types')->insert([
            'name' => "Laptop"
        ]);
        DB::table('asset_types')->insert([
            'name' => "Server"
        ]);
        DB::table('asset_types')->insert([
            'name' => "Mainframe"
        ]);
        DB::table('asset_types')->insert([
            'name' => "IP Camera"
        ]);
        DB::table('asset_types')->insert([
            'name' => "Analog Camera"
        ]);
        DB::table('asset_types')->insert([
            'name' => "NVR"
        ]);
        DB::table('asset_types')->insert([
            'name' => "DVR"
        ]);
        DB::table('asset_types')->insert([
            'name' => "Desktop"
        ]);
        DB::table('asset_types')->insert([
            'name' => "Workstation"
        ]);
        DB::table('asset_types')->insert([
            'name' => "Other"
        ]);
    }
}
