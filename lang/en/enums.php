<?php

use App\Enums\AssetOperationType;
use App\Enums\ControlType;
use App\Enums\ManufacturerContractType;
use App\Enums\UserRole;
return [
    UserRole::ADMINISTRATOR->name => 'Administrator',
    UserRole::SECURITY_OFFICER->name => 'Security Officer',
    UserRole::ASSET_MANAGER->name => 'Asset Manager',
    UserRole::DATA_PROTECTION_OFFICER->name => 'Data Protection Officer',
    ManufacturerContractType::MAINTENANCE->name => 'Maintenance',
    ManufacturerContractType::WARRANTY->name => 'Warranty',
    ManufacturerContractType::SUPPORT->name => 'Support',
    ManufacturerContractType::NONE->name => 'No Warranty',
    ControlType::ACCEPT->name => "Accept",
    ControlType::MITIGATE->name => "Mitigate",
    ControlType::TRANSFER->name => "Transfer",
    AssetOperationType::CREATE->name => "Create Asset",
    AssetOperationType::UPDATE->name => "Update Asset",
    AssetOperationType::ADD_THREAT->name => "Add Threat to Asset",
    AssetOperationType::UPDATE_THREAT->name => "Update Asset Threat Details",
    AssetOperationType::REMOVE_THREAT->name => "Remove Threat from Asset",
    AssetOperationType::ADD_CONTROL->name => "Add Control to Asset Threat",
    AssetOperationType::REMOVE_CONTROL->name => "Remove Control from Asset Threat",
    AssetOperationType::TOGGLE_CONTROL_VALIDATION->name => "Toggle Control Validation from Asset Threat",
    AssetOperationType::TOGGLE_REMAINING_RISK_ACCEPTANCE->name => "Toggle Asset Remaining Risk Acceptance",

];
