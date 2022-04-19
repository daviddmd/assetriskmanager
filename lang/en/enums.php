<?php

use App\Enums\UserRole;

return [
    UserRole::ADMINISTRATOR->name => 'Administrator',
    UserRole::SECURITY_OFFICER->name => 'Security Officer',
    UserRole::ASSET_MANAGER->name => 'Asset Manager',
    UserRole::DATA_PROTECTION_OFFICER->name => 'Data Protection Officer'
];
