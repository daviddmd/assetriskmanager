<?php

namespace Database\Seeders;

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
        //1
        DB::table('threats')->insert([
            'name' => "RCE",
            'description' => "Remote Code and Command Execution and Injection",
        ]);
        //2
        DB::table('threats')->insert([
            'name' => "LPE",
            'description' => "Privilege Escalation",
        ]);
        //3
        DB::table('threats')->insert([
            'name' => "XSS",
            'description' => "Cross-Site Scripting",
        ]);
        //4
        DB::table('threats')->insert([
            'name' => "SQLi",
            'description' => "SQL Injection",
        ]);
        //5
        DB::table('threats')->insert([
            'name' => "Theft",
            'description' => "Robbery to Physical Premises",
        ]);
        //6
        DB::table('threats')->insert([
            'name' => "Fire",
            'description' => "Fire in any of the Buildings",
        ]);
        //7
        DB::table('threats')->insert([
            'name' => "Flooding",
            'description' => "Flooding in any of the base floors.",
        ]);
        //8
        DB::table('threats')->insert([
            'name' => "Unauthorized Local Access",
            'description' => "Unauthorized access in the intranet",
        ]);
        //9
        DB::table('threats')->insert([
            'name' => "Data Loss",
            'description' => "Data Loss due to Hardware Failure, Ransomware or Accident",
        ]);
        //10
        DB::table('threats')->insert([
            'name' => "SSRF",
            'description' => "Server-Side Request Forgery",
        ]);
        //11
        DB::table('threats')->insert([
            'name' => "Data Exfiltration",
            'description' => "Data Exfiltration from Insecure Devices in a Network",
        ]);
        //12
        DB::table('threats')->insert([
            'name' => "Security Misconfiguration",
            'description' => "Misconfiguration in newly installed, legacy or upgraded software",
        ]);
        //13
        DB::table('threats')->insert([
            'name' => "Vulnerable or Outdated Software Components",
            'description' => "Vulnerable Software Dependencies or Libraries used in installed Software",
        ]);
        //14
        DB::table('threats')->insert([
            'name' => "Security Logging and Monitoring Failures",
            'description' => "Inadequate or non-existent logging in software assets",
        ]);
        //15
        DB::table('threats')->insert([
            'name' => "Other Software Vulnerability",
            'description' => "Non-categorised software vulnerability that may lead to data exfiltration or network access",
        ]);
        //16
        DB::table('threats')->insert([
            'name' => "Software and Data Integrity Failures",
            'description' => "Failure in verifying integrity in critical data ingestion, software or dependencies updates and CI/CD pipelines",
        ]);
    }
}
