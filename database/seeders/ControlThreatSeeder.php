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
        /**
         * RCE: 2, 5, 8, 13, 14
         * Sanitization, Antivirus, DPI, Patches, Updates
         */
        foreach ([2, 5, 8, 13, 14] as $value) {
            DB::table('control_threat')->insert([
                'threat_id' => 1,
                'control_id' => $value,
            ]);
        }
        /**
         * LPE: 2, 4, 5, 9, 13, 14, 15, 16
         * Sanitization, ORM, AV, ACL, Patches, Updates, Logs
         */
        foreach ([2, 4, 5, 9, 13, 14, 15, 16] as $value) {
            DB::table('control_threat')->insert([
                'threat_id' => 2,
                'control_id' => $value,
            ]);
        }
        /**
         * XSS: 2, 3, 4, 18
         * Sanitization, SQL Prepared Statements, ORM, Frontend Framework
         */

        foreach ([2, 3, 4, 18] as $value) {
            DB::table('control_threat')->insert([
                'threat_id' => 3,
                'control_id' => $value,
            ]);
        }
        /**
         * SQLi: 2, 3, 4, 19
         * Sanitization, SQL Prepared Statements, ORM, Layer7
         */
        foreach ([2, 3, 4, 19] as $value) {
            DB::table('control_threat')->insert([
                'threat_id' => 4,
                'control_id' => $value,
            ]);
        }
        /**
         * Theft: 6, 7, 20
         * Video Cameras, Movement Detectors, Insurance
         */

        foreach ([6, 7, 20] as $value) {
            DB::table('control_threat')->insert([
                'threat_id' => 5,
                'control_id' => $value,
            ]);
        }

        /**
         * Fire: 6, 20, 23, 24
         * Video Cameras, Insurance, Fire Sprinklers, Smoke Detector
         */

        foreach ([6, 20, 23, 24] as $value) {
            DB::table('control_threat')->insert([
                'threat_id' => 6,
                'control_id' => $value,
            ]);
        }

        /**
         * Flooding: 6, 20
         * Video Cameras, Insurance
         */

        foreach ([6, 20] as $value) {
            DB::table('control_threat')->insert([
                'threat_id' => 7,
                'control_id' => $value,
            ]);
        }

        /**
         * Unauthorized Local Access: 1, 10, 14, 15, 25
         * Password Reset, 2FA, Update Software (LDAP, Auth Infrastructure), Employee Training
         *
         */

        foreach ([1, 10, 14, 15, 25] as $value) {
            DB::table('control_threat')->insert([
                'threat_id' => 8,
                'control_id' => $value,
            ]);
        }
        /**
         * Data Loss: 16, 19, 21, 22
         * Centralized Logging, Layer-7, OffSite and Cloud Backup
         */
        foreach ([16, 19, 21, 22] as $value) {
            DB::table('control_threat')->insert([
                'threat_id' => 9,
                'control_id' => $value,
            ]);
        }

        /**
         * Server-Side Request Forgery: 2, 13, 14
         * Input Validation, Patches, Updates
         */
        foreach ([2, 13, 14] as $value) {
            DB::table('control_threat')->insert([
                'threat_id' => 10,
                'control_id' => $value,
            ]);
        }

        /**
         * Data Exfiltration: 8, 9, 11, 14, 15, 16, 19
         * Deep Packet Inspection, Access Control Policy, Network Segmentation, Update Software, Enable Logging and Upload Logs, Layer-7
         */
        foreach ([8, 9, 11, 14, 15, 16, 19] as $value) {
            DB::table('control_threat')->insert([
                'threat_id' => 11,
                'control_id' => $value,
            ]);
        }

        /**
         * Security Misconfiguration: 15, 16, 26
         * Enable Logging and Upload Logs, Audit Configuration
         */
        foreach ([15, 16, 26] as $value) {
            DB::table('control_threat')->insert([
                'threat_id' => 12,
                'control_id' => $value,
            ]);
        }

        /**
         * Vulnerable or Outdated Software Components: 13, 14, 15, 16, 19
         * Install Patches and Updates, Enable Logging and Upload Logs, Layer-7
         */
        foreach ([13, 14, 15, 16, 19] as $value) {
            DB::table('control_threat')->insert([
                'threat_id' => 13,
                'control_id' => $value,
            ]);
        }

        /**
         * Security Logging and Monitoring Failures: 15, 16
         * Enable Logging and Upload Logs
         */
        foreach ([15, 16] as $value) {
            DB::table('control_threat')->insert([
                'threat_id' => 14,
                'control_id' => $value,
            ]);
        }

        /**
         * Other Software Vulnerability: 9, 11, 13, 14, 15, 16, 17, 19, 26
         * Access Control Policy, Network Segmentation, Access Control Policy, Patches, Updates, Enable and Upload Logs, Fuzzing, Layer-7, Audit Configuration
         */
        foreach ([9, 11, 13, 14, 15, 16, 17, 19, 26] as $value) {
            DB::table('control_threat')->insert([
                'threat_id' => 15,
                'control_id' => $value,
            ]);
        }

        /**
         * Software and Data Integrity Failures: 13, 14, 15, 16, 17, 19, 26
         * Access Control Policy, Patches, Updates, Enable and Upload Logs, Fuzzing, Layer-7, Audit Configuration
         */
        foreach ([13, 14, 15, 16, 17, 19, 26] as $value) {
            DB::table('control_threat')->insert([
                'threat_id' => 16,
                'control_id' => $value,
            ]);
        }

        /**
         * Denial of Service: 8, 14, 15, 16, 19, 27
         * DPI, Update Software, Logs, Upload Logs, Layer-7, Layer3+4
         */
        foreach ([8, 14, 15, 16, 19, 27] as $value) {
            DB::table('control_threat')->insert([
                'threat_id' => 17,
                'control_id' => $value,
            ]);
        }
    }
}
