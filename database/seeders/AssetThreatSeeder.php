<?php

namespace Database\Seeders;

use App\Models\AssetThreat;
use Illuminate\Database\Seeder;

class AssetThreatSeeder extends Seeder
{
    public function run()
    {
        /**
         * Cisco Router Catalyst 8300: Security Misconfiguration, Outdated Software, Security Logging, DDoS
         */
        AssetThreat::create([
            "asset_id" => 1,
            "threat_id" => 12,
            "probability" => 3,
            "confidentiality_impact" => 4,
            "availability_impact" => 2,
            "integrity_impact" => 2,
            "residual_risk" => 25,
            "residual_risk_accepted" => true
        ]);
        AssetThreat::create([
            "asset_id" => 1,
            "threat_id" => 13,
            "probability" => 4,
            "confidentiality_impact" => 1,
            "availability_impact" => 2,
            "integrity_impact" => 2,
            "residual_risk" => 20,
            "residual_risk_accepted" => true
        ]);
        AssetThreat::create([
            "asset_id" => 1,
            "threat_id" => 14,
            "probability" => 3,
            "confidentiality_impact" => 1,
            "availability_impact" => 1,
            "integrity_impact" => 1,
            "residual_risk" => 1,
            "residual_risk_accepted" => true
        ]);
        AssetThreat::create([
            "asset_id" => 1,
            "threat_id" => 17,
            "probability" => 5,
            "confidentiality_impact" => 1,
            "availability_impact" => 5,
            "integrity_impact" => 3,
            "residual_risk" => 50,
            "residual_risk_accepted" => true
        ]);

        /**
         * Cisco Switch N2K-C2248TP: Security Misconfiguration, Outdated Software, Security Logging
         * Cisco Catalyst 2960-L: Security Misconfiguration, Outdated Software, Security Logging
         * Cisco Catalyst 9300: Security Misconfiguration, Outdated Software, Security Logging
         * Mikrotik Switch CSS610: Security Misconfiguration, Outdated Software, Security Logging
         */
        foreach ([2, 3, 4, 10] as $asset_id) {
            AssetThreat::create([
                "asset_id" => $asset_id,
                "threat_id" => 12,
                "probability" => 3,
                "confidentiality_impact" => 2,
                "availability_impact" => 2,
                "integrity_impact" => 2,
                "residual_risk" => 15,
                "residual_risk_accepted" => true
            ]);
            AssetThreat::create([
                "asset_id" => $asset_id,
                "threat_id" => 13,
                "probability" => 4,
                "confidentiality_impact" => 1,
                "availability_impact" => 2,
                "integrity_impact" => 2,
                "residual_risk" => 10,
                "residual_risk_accepted" => true
            ]);
            AssetThreat::create([
                "asset_id" => $asset_id,
                "threat_id" => 14,
                "probability" => 3,
                "confidentiality_impact" => 1,
                "availability_impact" => 1,
                "integrity_impact" => 1,
                "residual_risk" => 1,
                "residual_risk_accepted" => false
            ]);
        }

        /**
         * Hikvision IP Camera: Outdated Firmware, Data Exfiltration
         */
        AssetThreat::create([
            "asset_id" => 5,
            "threat_id" => 13,
            "probability" => 4,
            "confidentiality_impact" => 1,
            "availability_impact" => 2,
            "integrity_impact" => 4,
            "residual_risk" => 0,
            "residual_risk_accepted" => false
        ]);
        AssetThreat::create([
            "asset_id" => 5,
            "threat_id" => 11,
            "probability" => 4,
            "confidentiality_impact" => 5,
            "availability_impact" => 2,
            "integrity_impact" => 2,
            "residual_risk" => 20,
            "residual_risk_accepted" => true
        ]);

        /**
         * Hikvision NVR: Outdated Firmware, Data Exfiltration, Unauthorized Local Access, Data Loss
         */
        AssetThreat::create([
            "asset_id" => 6,
            "threat_id" => 13,
            "probability" => 4,
            "confidentiality_impact" => 5,
            "availability_impact" => 2,
            "integrity_impact" => 4,
            "residual_risk" => 50,
            "residual_risk_accepted" => true
        ]);
        AssetThreat::create([
            "asset_id" => 6,
            "threat_id" => 11,
            "probability" => 4,
            "confidentiality_impact" => 5,
            "availability_impact" => 2,
            "integrity_impact" => 2
        ]);
        AssetThreat::create([
            "asset_id" => 6,
            "threat_id" => 8,
            "probability" => 3,
            "confidentiality_impact" => 5,
            "availability_impact" => 2,
            "integrity_impact" => 2
        ]);
        AssetThreat::create([
            "asset_id" => 6,
            "threat_id" => 9,
            "probability" => 3,
            "confidentiality_impact" => 1,
            "availability_impact" => 4,
            "integrity_impact" => 4
        ]);

        /**
         * Dell Optiplex Desktops: Outdated Software, Data Exfiltration, Data Loss, Theft
         * HP EasyStore NAS: Outdated Software, Data Exfiltration, Data Loss, Theft
         * HP StoreEasy NAS:  Outdated Software, Data Exfiltration, Data Loss, Theft
         */
        foreach ([7, 8, 12] as $asset_id) {
            AssetThreat::create([
                "asset_id" => $asset_id,
                "threat_id" => 13,
                "probability" => 3,
                "confidentiality_impact" => 4,
                "availability_impact" => 2,
                "integrity_impact" => 4,
                "residual_risk" => 20,
                "residual_risk_accepted" => true
            ]);
            AssetThreat::create([
                "asset_id" => $asset_id,
                "threat_id" => 11,
                "probability" => 3,
                "confidentiality_impact" => 5,
                "availability_impact" => 2,
                "integrity_impact" => 2,
                "residual_risk" => 15,
                "residual_risk_accepted" => true
            ]);
            AssetThreat::create([
                "asset_id" => $asset_id,
                "threat_id" => 9,
                "probability" => 3,
                "confidentiality_impact" => 1,
                "availability_impact" => 4,
                "integrity_impact" => 4,
                "residual_risk" => 25,
                "residual_risk_accepted" => true
            ]);
            AssetThreat::create([
                "asset_id" => $asset_id,
                "threat_id" => 5,
                "probability" => 2,
                "confidentiality_impact" => 5,
                "availability_impact" => 5,
                "integrity_impact" => 1,
                "residual_risk" => 20,
                "residual_risk_accepted" => true
            ]);
        }
        /**
         * Dell PowerEdge Server: Data Exfiltration, DoS, Data Loss, Security Misconfiguration, Unauthorized Local Access
         * HPE ProLiant Server: Data Exfiltration, DoS, Data Loss, Security Misconfiguration, Unauthorized Local Access, Data Integrity Failure
         */
        foreach ([9, 11] as $asset_id) {
            AssetThreat::create([
                "asset_id" => $asset_id,
                "threat_id" => 11,
                "probability" => 3,
                "confidentiality_impact" => 5,
                "availability_impact" => 2,
                "integrity_impact" => 4,
                "residual_risk" => "30",
                "residual_risk_accepted" => true
            ]);
            AssetThreat::create([
                "asset_id" => $asset_id,
                "threat_id" => 17,
                "probability" => 2,
                "confidentiality_impact" => 1,
                "availability_impact" => 4,
                "integrity_impact" => 2,
                "residual_risk" => "5",
                "residual_risk_accepted" => true
            ]);
            AssetThreat::create([
                "asset_id" => $asset_id,
                "threat_id" => 9,
                "probability" => 3,
                "confidentiality_impact" => 1,
                "availability_impact" => 4,
                "integrity_impact" => 4,
                "residual_risk" => "20",
                "residual_risk_accepted" => true
            ]);
            AssetThreat::create([
                "asset_id" => $asset_id,
                "threat_id" => 12,
                "probability" => 3,
                "confidentiality_impact" => 3,
                "availability_impact" => 2,
                "integrity_impact" => 2,
                "residual_risk" => "15",
                "residual_risk_accepted" => true
            ]);
            AssetThreat::create([
                "asset_id" => $asset_id,
                "threat_id" => 8,
                "probability" => 2,
                "confidentiality_impact" => 5,
                "availability_impact" => 1,
                "integrity_impact" => 2,
                "residual_risk" => "25",
                "residual_risk_accepted" => true
            ]);
        }
        AssetThreat::create([
            "asset_id" => 11,
            "threat_id" => 16,
            "probability" => 4,
            "confidentiality_impact" => 2,
            "availability_impact" => 2,
            "integrity_impact" => 5,
            "residual_risk" => 0,
            "residual_risk_accepted" => false
        ]);
    }
}
