<?php

namespace App\Imports;

use App\Enums\ManufacturerContractType;
use App\Models\Asset;
use App\Models\AssetType;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AssetsImport implements ToModel, WithHeadingRow
{
    private function validate_appreciation($appreciation)
    {
        return filter_var(
            $appreciation,
            FILTER_VALIDATE_INT,
            array(
                'options' => array(
                    'min_range' => 1,
                    'max_range' => 5
                )
            )
        );
    }

    /**
     * @param array $row
     *
     * @return Model|null
     */
    public function model(array $row)
    {
        $existing_asset_ids = Asset::all()->pluck("id")->toArray();
        $existing_user_ids = User::all()->pluck("id")->toArray();
        $existing_asset_type_ids = AssetType::all()->pluck("id")->toArray();
        $asset_type_id = (int)$row["asset_type_id"];
        $manager_id = (int)$row["manager_id"];
        if (!in_array($manager_id, $existing_user_ids) || !in_array($asset_type_id, $existing_asset_type_ids)) {
            return null;
        }
        $manufacturer_contract_type = $row["manufacturer_contract_type"];
        $manufacturer_contract_type = empty($manufacturer_contract_type) || !ManufacturerContractType::tryFrom($manufacturer_contract_type) ? ManufacturerContractType::NONE : $manufacturer_contract_type;
        $manufacturer_contract_beginning_date = $row["manufacturer_contract_beginning_date"];
        $manufacturer_contract_beginning_date = empty($manufacturer_contract_beginning_date) || $manufacturer_contract_type == ManufacturerContractType::NONE ? null : $manufacturer_contract_beginning_date;
        $manufacturer_contract_ending_date = $row["manufacturer_contract_ending_date"];
        $manufacturer_contract_ending_date = empty($manufacturer_contract_ending_date) || $manufacturer_contract_type == ManufacturerContractType::NONE ? null : $manufacturer_contract_ending_date;
        $manufacturer_contract_provider = $row["manufacturer_contract_provider"];
        $manufacturer_contract_provider = $manufacturer_contract_type == ManufacturerContractType::NONE ? "" : $manufacturer_contract_provider;
        $availability_appreciation = (int)$row["availability_appreciation"];
        $availability_appreciation = $this->validate_appreciation($availability_appreciation) ? $availability_appreciation : 0;
        $integrity_appreciation = (int)$row["integrity_appreciation"];
        $integrity_appreciation = $this->validate_appreciation($integrity_appreciation) ? $integrity_appreciation : 0;
        $confidentiality_appreciation = (int)$row["confidentiality_appreciation"];
        $confidentiality_appreciation = $this->validate_appreciation($confidentiality_appreciation) ? $confidentiality_appreciation : 0;
        $active = $row["active"];
        $active = (bool)filter_var($active, FILTER_VALIDATE_BOOLEAN);
        $export = $row["export"];
        $export = (bool)filter_var($export, FILTER_VALIDATE_BOOLEAN);
        $links_to_id = (int)$row["links_to_id"];
        $links_to_id = in_array($links_to_id, $existing_asset_ids) ? $links_to_id : null;
        $version = $row["version"];
        return new Asset([
            'name' => $row["name"],
            'asset_type_id' => $asset_type_id,
            "manager_id" => $manager_id,
            "description" => $row["description"],
            "sku" => $row["sku"],
            "manufacturer" => $row["manufacturer"],
            "location" => $row["location"],
            "manufacturer_contract_type" => $manufacturer_contract_type,
            "manufacturer_contract_beginning_date" => $manufacturer_contract_beginning_date,
            "manufacturer_contract_ending_date" => $manufacturer_contract_ending_date,
            "manufacturer_contract_provider" => $manufacturer_contract_provider,
            "mac_address" => $row["mac_address"],
            "fqdn" => $row["fqdn"],
            "ip_address" => $row["ip_address"],
            "availability_appreciation" => $availability_appreciation,
            "integrity_appreciation" => $integrity_appreciation,
            "confidentiality_appreciation" => $confidentiality_appreciation,
            "export" => $export,
            "active" => $active,
            "links_to_id" => $links_to_id,
            "remainingRiskAccepted" => false,
            "version" => $version
        ]);
    }
}
