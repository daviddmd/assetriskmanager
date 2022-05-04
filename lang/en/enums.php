<?php

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

];
