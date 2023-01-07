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
        //1
        DB::table('controls')->insert([
            'name' => "Password Reset",
            'description' => "Forced Password Reset Policy every 30 days.",
        ]);
        //2
        DB::table('controls')->insert([
            'name' => "Input Sanitization and Validation",
            'description' => "Sanitize and Validate every user input in the software",
        ]);
        //3
        DB::table('controls')->insert([
            'name' => "SQL Prepared Statements",
            'description' => "Migrate from concatenated SQL queries to prepared sql statements.",
        ]);
        //4
        DB::table('controls')->insert([
            'name' => "ORM",
            'description' => "Upgrade the platform's SQL queries to use an ORM.",
        ]);
        //5
        DB::table('controls')->insert([
            'name' => "Antivirus",
            'description' => "Install AV/Antimalware software.",
        ]);
        //6
        DB::table('controls')->insert([
            'name' => "Install Video Cameras",
            'description' => "Install an array of video cameras on multiple buildings connected to a NVR.",
        ]);
        //7
        DB::table('controls')->insert([
            'name' => "Install Movement Detectors",
            'description' => "Install movement detectors on all doors that are armed and disarmed at specific hours of the day.",
        ]);
        //8
        DB::table('controls')->insert([
            'name' => "Deep Packet Inspection",
            'description' => "Process all packets coming through the firewall to detect malicious behaviour",
        ]);
        //9
        DB::table('controls')->insert([
            'name' => "Access Control Policy",
            'description' => "Define the adequate Access Control Policy for the software of an asset",
        ]);
        //10
        DB::table('controls')->insert([
            'name' => "Two-Factor Authentication",
            'description' => "Mandatory Two-Factor Authentication",
        ]);
        //11
        DB::table('controls')->insert([
            'name' => "Network Segmentation",
            'description' => "Segment and Isolate Individual Networks with VLANs",
        ]);
        //12
        DB::table('controls')->insert([
            'name' => "Two-Factor Authentication",
            'description' => "Mandatory Two-Factor Authentication",
        ]);
        //13
        DB::table('controls')->insert([
            'name' => "Apply Patches",
            'description' => "Install Patches to fix Security Issues",
        ]);
        //14
        DB::table('controls')->insert([
            'name' => "Update Software",
            'description' => "Install Updates from the vendor",
        ]);
        //15
        DB::table('controls')->insert([
            'name' => "Enable and Configure Logging",
            'description' => "Enable Logging, set its granularity level",
        ]);
        //16
        DB::table('controls')->insert([
            'name' => "Upload logs to a centralized platform",
            'description' => "Upload the logs from the asset to a central logging platform that aggregates them to provide statistics and analyse suspicious behavior",
        ]);
        //17
        DB::table('controls')->insert([
            'name' => "Fuzzing",
            'description' => "Black-box and White-Box input fuzzing",
        ]);
        //18
        DB::table('controls')->insert([
            'name' => "Install and Audit Front-end framework",
            'description' => "Install and audit front-end framework and audit DOM manipulation and template policies to deal with XSS",
        ]);
        //19
        DB::table('controls')->insert([
            'name' => "Install and Configure Layer-7 Firewall",
            'description' => "Install and Configure On-Premises or Third-party Layer-7 Firewall",
        ]);
        //20
        DB::table('controls')->insert([
            'name' => "Insure Asset",
            'description' => "Acquire Insurance for the Asset",
        ]);
        //21
        DB::table('controls')->insert([
            'name' => "Off-Site Backup",
            'description' => "Develop and Implement an Off-Site backup strategy for the storage of software assets",
        ]);
        //22
        DB::table('controls')->insert([
            'name' => "Cloud Backup",
            'description' => "Develop and Implement an Cloud backup strategy for the storage of software assets",
        ]);
        //23
        DB::table('controls')->insert([
            'name' => "Install Fire Sprinklers",
            'description' => "Install water storage and fire sprinklers",
        ]);
        //24
        DB::table('controls')->insert([
            'name' => "Install Smoke Detectors",
            'description' => "Install smoke detectors and connect them to central telephony",
        ]);
        //25
        DB::table('controls')->insert([
            'name' => "Employee Cyber-security Awareness Training",
            'description' => "Train employees to recognise phishing, fraud and malware attempts",
        ]);
        //26
        DB::table('controls')->insert([
            'name' => "Audit Configuration",
            'description' => "Audit Software Configuration of the Asset",
        ]);
    }
}
