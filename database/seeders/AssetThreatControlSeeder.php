<?php

namespace Database\Seeders;

use App\Enums\ControlType;
use App\Models\AssetThreat;
use App\Models\AssetThreatControl;
use Illuminate\Database\Seeder;

class AssetThreatControlSeeder extends Seeder
{
    public function run()
    {
        /**
         * Cisco Router Catalyst 8300
         * Security Misconfiguration: Audit Configuration
         * Vulnerable or Outdated Software Components: Update Software
         * Security Logging and Monitoring Failures: Enable and Configure Logging, Upload logs to a centralized platform
         * Dos: Layer 7, Layer 3+4, DPI, Update Software
         */
        AssetThreatControl::create([
            "asset_threat_id" => AssetThreat::where("asset_id", "=", 1)->where("threat_id", "=", 12)->first("id")->id,
            "control_id" => 26,
            "control_type" => ControlType::MITIGATE
        ]);
        AssetThreatControl::create([
            "asset_threat_id" => AssetThreat::where("asset_id", "=", 1)->where("threat_id", "=", 13)->first("id")->id,
            "control_id" => 14,
            "control_type" => ControlType::MITIGATE
        ]);
        foreach ([15, 16] as $control_id) {
            AssetThreatControl::create([
                "asset_threat_id" => AssetThreat::where("asset_id", "=", 1)->where("threat_id", "=", 14)->first("id")->id,
                "control_id" => $control_id,
                "control_type" => ControlType::MITIGATE,
                "validated" => true
            ]);
        }
        foreach ([8, 14, 19, 27] as $control_id) {
            AssetThreatControl::create([
                "asset_threat_id" => AssetThreat::where("asset_id", "=", 1)->where("threat_id", "=", 17)->first("id")->id,
                "control_id" => $control_id,
                "control_type" => ControlType::MITIGATE,
                "validated" => true
            ]);
        }
        /**
         * Cisco Switch N2K-C2248TP: Security Misconfiguration, Outdated Software, Security Logging
         * Cisco Catalyst 2960-L: Security Misconfiguration, Outdated Software, Security Logging
         * Cisco Catalyst 9300: Security Misconfiguration, Outdated Software, Security Logging
         * Mikrotik Switch CSS610: Security Misconfiguration, Outdated Software, Security Logging
         * Security Misconfiguration: Audit Configuration
         * Vulnerable or Outdated Software Components: Update Software
         * Security Logging and Monitoring Failures: Enable and Configure Logging, Upload logs to a centralized platform
         */
        foreach ([2, 3, 4, 10] as $asset_id) {
            AssetThreatControl::create([
                "asset_threat_id" => AssetThreat::where("asset_id", "=", $asset_id)->where("threat_id", "=", 12)->first("id")->id,
                "control_id" => 26,
                "control_type" => ControlType::MITIGATE
            ]);
            AssetThreatControl::create([
                "asset_threat_id" => AssetThreat::where("asset_id", "=", $asset_id)->where("threat_id", "=", 13)->first("id")->id,
                "control_id" => 14,
                "control_type" => ControlType::MITIGATE
            ]);
            foreach ([15, 16] as $control_id) {
                AssetThreatControl::create([
                    "asset_threat_id" => AssetThreat::where("asset_id", "=", $asset_id)->where("threat_id", "=", 14)->first("id")->id,
                    "control_id" => $control_id,
                    "control_type" => ControlType::MITIGATE,
                    "validated" => true
                ]);
            }
        }
        /**
         * Hikvision IP Cameras
         * Vulnerable or Outdated Software Components: Update Software
         * Data Exfiltration: Enable and Configure Logging, Upload logs to a centralized platform, Network Segmentation
         */
        AssetThreatControl::create([
            "asset_threat_id" => AssetThreat::where("asset_id", "=", 5)->where("threat_id", "=", 13)->first("id")->id,
            "control_id" => 14,
            "control_type" => ControlType::MITIGATE
        ]);

        foreach ([11, 15, 16] as $control_id) {
            AssetThreatControl::create([
                "asset_threat_id" => AssetThreat::where("asset_id", "=", 5)->where("threat_id", "=", 11)->first("id")->id,
                "control_id" => $control_id,
                "control_type" => ControlType::MITIGATE,
                "validated" => true
            ]);
        }

        /**
         * Hikvision NVR
         * Vulnerable or Outdated Software Components: Update Software
         * Data Exfiltration: Enable and Configure Logging, Upload logs to a centralized platform, Network Segmentation
         * Unauthorized Local Access: Enable and Configure Logging (Accept), Password Reset, Two-Factor Authentication
         * Data Loss: Off-Site Backup, Cloud Backup (Transfer),
         */
        AssetThreatControl::create([
            "asset_threat_id" => AssetThreat::where("asset_id", "=", 6)->where("threat_id", "=", 13)->first("id")->id,
            "control_id" => 14,
            "control_type" => ControlType::MITIGATE
        ]);
        foreach ([11, 15, 16] as $control_id) {
            AssetThreatControl::create([
                "asset_threat_id" => AssetThreat::where("asset_id", "=", 6)->where("threat_id", "=", 11)->first("id")->id,
                "control_id" => $control_id,
                "control_type" => ControlType::MITIGATE,
                "validated" => true
            ]);
        }
        AssetThreatControl::create([
            "asset_threat_id" => AssetThreat::where("asset_id", "=", 6)->where("threat_id", "=", 8)->first("id")->id,
            "control_id" => 15,
            "control_type" => ControlType::ACCEPT
        ]);
        AssetThreatControl::create([
            "asset_threat_id" => AssetThreat::where("asset_id", "=", 6)->where("threat_id", "=", 8)->first("id")->id,
            "control_id" => 1,
            "control_type" => ControlType::MITIGATE,
        ]);
        AssetThreatControl::create([
            "asset_threat_id" => AssetThreat::where("asset_id", "=", 6)->where("threat_id", "=", 8)->first("id")->id,
            "control_id" => 10,
            "control_type" => ControlType::MITIGATE
        ]);
        AssetThreatControl::create([
            "asset_threat_id" => AssetThreat::where("asset_id", "=", 6)->where("threat_id", "=", 9)->first("id")->id,
            "control_id" => 21,
            "control_type" => ControlType::MITIGATE
        ]);
        AssetThreatControl::create([
            "asset_threat_id" => AssetThreat::where("asset_id", "=", 6)->where("threat_id", "=", 9)->first("id")->id,
            "control_id" => 22,
            "control_type" => ControlType::TRANSFER
        ]);

        /**
         * Dell Optiplex Desktops: Outdated Software, Data Exfiltration, Data Loss, Theft
         * HP EasyStore NAS: Outdated Software, Data Exfiltration, Data Loss, Theft
         * HP StoreEasy NAS:  Outdated Software, Data Exfiltration, Data Loss, Theft
         * Vulnerable or Outdated Software Components: Update Software
         * Data Exfiltration: Enable and Configure Logging, Upload logs to a centralized platform, Network Segmentation
         * Data Loss: Off-Site Backup, Cloud Backup (Transfer)
         * Theft: Install Video Cameras, Install Movement Detectors, Insure Asset
         */
        foreach ([7, 8, 12] as $asset_id) {
            AssetThreatControl::create([
                "asset_threat_id" => AssetThreat::where("asset_id", "=", $asset_id)->where("threat_id", "=", 13)->first("id")->id,
                "control_id" => 14,
                "control_type" => ControlType::MITIGATE
            ]);
            foreach ([11, 15, 16] as $control_id) {
                AssetThreatControl::create([
                    "asset_threat_id" => AssetThreat::where("asset_id", "=", $asset_id)->where("threat_id", "=", 11)->first("id")->id,
                    "control_id" => $control_id,
                    "control_type" => ControlType::MITIGATE,
                    "validated" => true
                ]);
            }
            AssetThreatControl::create([
                "asset_threat_id" => AssetThreat::where("asset_id", "=", $asset_id)->where("threat_id", "=", 9)->first("id")->id,
                "control_id" => 21,
                "control_type" => ControlType::MITIGATE
            ]);
            AssetThreatControl::create([
                "asset_threat_id" => AssetThreat::where("asset_id", "=", $asset_id)->where("threat_id", "=", 9)->first("id")->id,
                "control_id" => 22,
                "control_type" => ControlType::TRANSFER
            ]);
            foreach ([6, 7, 20] as $control_id) {
                AssetThreatControl::create([
                    "asset_threat_id" => AssetThreat::where("asset_id", "=", $asset_id)->where("threat_id", "=", 5)->first("id")->id,
                    "control_id" => $control_id,
                    "control_type" => ControlType::MITIGATE,
                    "validated" => true
                ]);
            }
        }

        /**
         * Dell PowerEdge Server: Data Exfiltration, DoS, Data Loss, Security Misconfiguration, Unauthorized Local Access
         * HPE ProLiant Server: Data Exfiltration, DoS, Data Loss, Security Misconfiguration, Unauthorized Local Access, Data Integrity Failure
         * Data Exfiltration: Enable and Configure Logging, Upload logs to a centralized platform, Network Segmentation
         * DoS: Layer-7 (Transfer)
         * Data Loss: Off-Site Backup, Cloud Backup (Transfer)
         * Security Misconfiguration: Audit Configuration
         * Unauthorized Local Access: Enable and Configure Logging (Accept)
         */

        foreach ([9, 11] as $asset_id) {
            foreach ([11, 15, 16] as $control_id) {
                AssetThreatControl::create([
                    "asset_threat_id" => AssetThreat::where("asset_id", "=", $asset_id)->where("threat_id", "=", 11)->first("id")->id,
                    "control_id" => $control_id,
                    "control_type" => ControlType::MITIGATE,
                    "validated" => true
                ]);
            }
            AssetThreatControl::create([
                "asset_threat_id" => AssetThreat::where("asset_id", "=", $asset_id)->where("threat_id", "=", 17)->first("id")->id,
                "control_id" => 19,
                "control_type" => ControlType::TRANSFER
            ]);
            AssetThreatControl::create([
                "asset_threat_id" => AssetThreat::where("asset_id", "=", $asset_id)->where("threat_id", "=", 9)->first("id")->id,
                "control_id" => 21,
                "control_type" => ControlType::MITIGATE
            ]);
            AssetThreatControl::create([
                "asset_threat_id" => AssetThreat::where("asset_id", "=", $asset_id)->where("threat_id", "=", 9)->first("id")->id,
                "control_id" => 22,
                "control_type" => ControlType::TRANSFER
            ]);
            AssetThreatControl::create([
                "asset_threat_id" => AssetThreat::where("asset_id", "=", $asset_id)->where("threat_id", "=", 12)->first("id")->id,
                "control_id" => 26,
                "control_type" => ControlType::MITIGATE
            ]);
            AssetThreatControl::create([
                "asset_threat_id" => AssetThreat::where("asset_id", "=", $asset_id)->where("threat_id", "=", 8)->first("id")->id,
                "control_id" => 15,
                "control_type" => ControlType::ACCEPT
            ]);
        }
        AssetThreatControl::create([
            "asset_threat_id" => AssetThreat::where("asset_id", "=", 11)->where("threat_id", "=", 16)->first("id")->id,
            "control_id" => 19,
            "control_type" => ControlType::ACCEPT
        ]);
        foreach ([14, 15, 16, 26] as $control_id) {
            AssetThreatControl::create([
                "asset_threat_id" => AssetThreat::where("asset_id", "=", 11)->where("threat_id", "=", 16)->first("id")->id,
                "control_id" => $control_id,
                "control_type" => ControlType::ACCEPT,
                "validated" => true
            ]);
        }

    }
}
