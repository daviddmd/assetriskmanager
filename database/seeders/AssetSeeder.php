<?php

namespace Database\Seeders;

use App\Enums\ManufacturerContractType;
use App\Models\Asset;
use Faker\Factory;
use Illuminate\Database\Seeder;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create("pt_PT");
        //1
        Asset::create([
            "name" => "Cisco Router Catalyst 8300",
            "asset_type_id" => 1,
            "manager_id" => 5,
            "description" => "Router for Building 2.\nConnects to all switches in Building 2.",
            "sku" => $faker->ean13(),
            "manufacturer" => "Cisco",
            "location" => "B2-1",
            "manufacturer_contract_type" => ManufacturerContractType::SUPPORT,
            "manufacturer_contract_beginning_date" => "2022-06-01",
            "manufacturer_contract_ending_date" => "2025-06-20",
            "manufacturer_contract_provider" => $faker->company(),
            "mac_address" => $faker->macAddress(),
            "fqdn" => "router.2.rjsc.local",
            "ip_address" => $faker->localIpv4(),
            "availability_appreciation" => 4,
            "integrity_appreciation" => 2,
            "confidentiality_appreciation" => 1,
            "export" => true,
            "active" => true,
            "links_to_id" => null,
            "remainingRiskAccepted" => false,
            "version" => "1.0.0"
        ]);
        //2
        Asset::create([
            "name" => "Cisco Switch N2K-C2248TP",
            "asset_type_id" => 2,
            "manager_id" => 4,
            "description" => "Cisco Switch N2K-C2248TP for all devices and child Switches in Floor 6 of Building 2.",
            "sku" => $faker->ean13(),
            "manufacturer" => "Cisco",
            "location" => "B2-6",
            "manufacturer_contract_type" => ManufacturerContractType::WARRANTY,
            "manufacturer_contract_beginning_date" => "2023-01-01",
            "manufacturer_contract_ending_date" => "2026-01-01",
            "manufacturer_contract_provider" => $faker->company(),
            "mac_address" => $faker->macAddress(),
            "fqdn" => "switch.2-6.rjsc.local",
            "ip_address" => $faker->localIpv4(),
            "availability_appreciation" => 3,
            "integrity_appreciation" => 2,
            "confidentiality_appreciation" => 1,
            "export" => true,
            "active" => true,
            "links_to_id" => 1,
            "remainingRiskAccepted" => false,
            "version" => "1.0.1"
        ]);
        //3
        Asset::create([
            "name" => "Cisco Catalyst 2960-L",
            "asset_type_id" => 2,
            "manager_id" => 4,
            "description" => "Cisco Switch 2960-L for all devices in Floor 4 of Building 2.",
            "sku" => $faker->ean13(),
            "manufacturer" => "Cisco",
            "location" => "B2-4",
            "manufacturer_contract_type" => ManufacturerContractType::WARRANTY,
            "manufacturer_contract_beginning_date" => "2023-01-01",
            "manufacturer_contract_ending_date" => "2026-01-01",
            "manufacturer_contract_provider" => $faker->company(),
            "mac_address" => $faker->macAddress(),
            "fqdn" => "switch.2-4.rjsc.local",
            "ip_address" => $faker->localIpv4(),
            "availability_appreciation" => 2,
            "integrity_appreciation" => 2,
            "confidentiality_appreciation" => 1,
            "export" => true,
            "active" => true,
            "links_to_id" => 1,
            "remainingRiskAccepted" => false,
            "version" => "1.0.2"
        ]);
        //4
        Asset::create([
            "name" => "Cisco Catalyst 9300",
            "asset_type_id" => 2,
            "manager_id" => 4,
            "description" => "Cisco Switch 9300 for all IP Cameras in Floor 5 of Building 2",
            "sku" => $faker->ean13(),
            "manufacturer" => "Cisco",
            "location" => "B2-5",
            "manufacturer_contract_type" => ManufacturerContractType::WARRANTY,
            "manufacturer_contract_beginning_date" => "2022-02-02",
            "manufacturer_contract_ending_date" => "2024-04-04",
            "manufacturer_contract_provider" => $faker->company(),
            "mac_address" => $faker->macAddress(),
            "fqdn" => "switch.2-5.cam.rjsc.local",
            "ip_address" => $faker->localIpv4(),
            "availability_appreciation" => 2,
            "integrity_appreciation" => 2,
            "confidentiality_appreciation" => 1,
            "export" => true,
            "active" => true,
            "links_to_id" => 1,
            "remainingRiskAccepted" => false,
            "version" => "1.0.3"
        ]);
        //5
        Asset::create([
            "name" => "Hikvision IP Cameras",
            "asset_type_id" => 6,
            "manager_id" => 6,
            "description" => "16x Hikvision DS-2CD2H23G2-IZS PoE IP Cameras",
            "sku" => $faker->ean13(),
            "manufacturer" => "Hikvision",
            "location" => "B2-5",
            "manufacturer_contract_type" => ManufacturerContractType::SUPPORT,
            "manufacturer_contract_beginning_date" => "2022-01-15",
            "manufacturer_contract_ending_date" => "2026-06-06",
            "manufacturer_contract_provider" => $faker->company(),
            "mac_address" => "",
            "fqdn" => "",
            "ip_address" => "",
            "availability_appreciation" => 2,
            "integrity_appreciation" => 1,
            "confidentiality_appreciation" => 1,
            "export" => true,
            "active" => true,
            "links_to_id" => 4,
            "remainingRiskAccepted" => false,
            "version" => "1.0.4"
        ]);
        //6
        Asset::create([
            "name" => "Hikvision NVR",
            "asset_type_id" => 8,
            "manager_id" => 6,
            "description" => "Hikvision DS-9616NI-M8 16 channel NVR",
            "sku" => $faker->ean13(),
            "manufacturer" => "Hikvision",
            "location" => "B2-5",
            "manufacturer_contract_type" => ManufacturerContractType::MAINTENANCE,
            "manufacturer_contract_beginning_date" => "2022-07-07",
            "manufacturer_contract_ending_date" => "2026-07-07",
            "manufacturer_contract_provider" => $faker->company(),
            "mac_address" => $faker->macAddress(),
            "fqdn" => "nvr.2-5.rjsc.local",
            "ip_address" => $faker->localIpv4(),
            "availability_appreciation" => 2,
            "integrity_appreciation" => 2,
            "confidentiality_appreciation" => 5,
            "export" => true,
            "active" => true,
            "links_to_id" => 4,
            "remainingRiskAccepted" => false,
            "version" => "1.0.5"
        ]);
        //7
        Asset::create([
            "name" => "Dell Optiplex Desktops",
            "asset_type_id" => 11,
            "manager_id" => 7,
            "description" => "30x Dell Optiplex 7070 Desktops for Floor 4 of Building 2",
            "sku" => $faker->ean13(),
            "manufacturer" => "Dell",
            "location" => "B2-4",
            "manufacturer_contract_type" => ManufacturerContractType::WARRANTY,
            "manufacturer_contract_beginning_date" => "2023-01-02",
            "manufacturer_contract_ending_date" => "2027-01-02",
            "manufacturer_contract_provider" => $faker->company(),
            "mac_address" => "",
            "fqdn" => "",
            "ip_address" => "",
            "availability_appreciation" => 2,
            "integrity_appreciation" => 2,
            "confidentiality_appreciation" => 4,
            "export" => true,
            "active" => true,
            "links_to_id" => 3,
            "remainingRiskAccepted" => false,
            "version" => "Windows 11 22H2 (10.0.22621.1194)"
        ]);
        //8
        Asset::create([
            "name" => "HP StoreEasy NAS",
            "asset_type_id" => 11,
            "manager_id" => 7,
            "description" => "12 TB HPE StoreEasy 1560 for Floor 4 of Building 2",
            "sku" => $faker->ean13(),
            "manufacturer" => "HP",
            "location" => "B2-4",
            "manufacturer_contract_type" => ManufacturerContractType::WARRANTY,
            "manufacturer_contract_beginning_date" => "2023-01-04",
            "manufacturer_contract_ending_date" => "2027-01-04",
            "manufacturer_contract_provider" => $faker->company(),
            "mac_address" => $faker->macAddress(),
            "fqdn" => "nas.2-4.rjsc.local",
            "ip_address" => $faker->ipv4(),
            "availability_appreciation" => 3,
            "integrity_appreciation" => 3,
            "confidentiality_appreciation" => 5,
            "export" => true,
            "active" => true,
            "links_to_id" => 3,
            "remainingRiskAccepted" => false,
            "version" => "10.22.2"
        ]);
        //9
        Asset::create([
            "name" => "Dell PowerEdge Server",
            "asset_type_id" => 4,
            "manager_id" => 8,
            "description" => "Dell PowerEdge R6525 Server to host Internal Services and VPN",
            "sku" => $faker->ean13(),
            "manufacturer" => "Dell",
            "location" => "B2-6",
            "manufacturer_contract_type" => ManufacturerContractType::WARRANTY,
            "manufacturer_contract_beginning_date" => "2023-01-08",
            "manufacturer_contract_ending_date" => "2030-01-08",
            "manufacturer_contract_provider" => $faker->company(),
            "mac_address" => $faker->macAddress(),
            "fqdn" => "server.2-6-1.rjsc.local",
            "ip_address" => $faker->ipv4(),
            "availability_appreciation" => 5,
            "integrity_appreciation" => 4,
            "confidentiality_appreciation" => 5,
            "export" => true,
            "active" => true,
            "links_to_id" => 2,
            "remainingRiskAccepted" => false,
            "version" => "Linux 6.1.9"
        ]);
        //10
        Asset::create([
            "name" => "Mikrotik Switch",
            "asset_type_id" => 2,
            "manager_id" => 8,
            "description" => "Mikrotik CSS610 Switch for the Devices of Floor 6 of Building 2",
            "sku" => $faker->ean13(),
            "manufacturer" => "Mikrotik",
            "location" => "B2-6",
            "manufacturer_contract_type" => ManufacturerContractType::NONE,
            "manufacturer_contract_beginning_date" => null,
            "manufacturer_contract_ending_date" => null,
            "manufacturer_contract_provider" => "",
            "mac_address" => $faker->macAddress(),
            "fqdn" => "switch.2-6-1.rjsc.local",
            "ip_address" => $faker->ipv4(),
            "availability_appreciation" => 2,
            "integrity_appreciation" => 1,
            "confidentiality_appreciation" => 1,
            "export" => true,
            "active" => true,
            "links_to_id" => 2,
            "remainingRiskAccepted" => true,
            "version" => "2.13"
        ]);
        //11
        Asset::create([
            "name" => "HPE ProLiant Server",
            "asset_type_id" => 4,
            "manager_id" => 10,
            "description" => "HPE ProLiant DL160 Server to host internal CI/CD pipelines and HTTP Server",
            "sku" => $faker->ean13(),
            "manufacturer" => "HP",
            "location" => "B2-6",
            "manufacturer_contract_type" => ManufacturerContractType::SUPPORT,
            "manufacturer_contract_beginning_date" => "2022-12-01",
            "manufacturer_contract_ending_date" => "2026-12-02",
            "manufacturer_contract_provider" => $faker->company(),
            "mac_address" => $faker->macAddress(),
            "fqdn" => "server.2-6-2.rjsc.local",
            "ip_address" => $faker->ipv4(),
            "availability_appreciation" => 3,
            "integrity_appreciation" => 3,
            "confidentiality_appreciation" => 1,
            "export" => true,
            "active" => true,
            "links_to_id" => 10,
            "remainingRiskAccepted" => false,
            "version" => "Ubuntu 22.04.1"
        ]);
        //12
        Asset::create([
            "name" => "HP StoreEasy NAS",
            "asset_type_id" => 13,
            "manager_id" => 10,
            "description" => "32 TB HPE StoreEasy 1660 for Floor 6 of Building 2",
            "sku" => $faker->ean13(),
            "manufacturer" => "HP",
            "location" => "B2-6",
            "manufacturer_contract_type" => ManufacturerContractType::SUPPORT,
            "manufacturer_contract_beginning_date" => "2022-12-01",
            "manufacturer_contract_ending_date" => "2026-12-02",
            "manufacturer_contract_provider" => $faker->company(),
            "mac_address" => $faker->macAddress(),
            "fqdn" => "nas.2-6.rjsc.local",
            "ip_address" => $faker->ipv4(),
            "availability_appreciation" => 3,
            "integrity_appreciation" => 3,
            "confidentiality_appreciation" => 4,
            "export" => true,
            "active" => true,
            "links_to_id" => 10,
            "remainingRiskAccepted" => false,
            "version" => "50.44"
        ]);
    }
}
