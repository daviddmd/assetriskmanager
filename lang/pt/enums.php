<?php

use App\Enums\AssetOperationType;
use App\Enums\ControlType;
use App\Enums\ManufacturerContractType;
use App\Enums\UserRole;

return [
    UserRole::ADMINISTRATOR->name => 'Administrador',
    UserRole::SECURITY_OFFICER->name => 'Security Officer',
    UserRole::ASSET_MANAGER->name => 'Gestor de Ativos',
    UserRole::DATA_PROTECTION_OFFICER->name => 'Data Protection Officer',
    ManufacturerContractType::MAINTENANCE->name => 'Manutenção',
    ManufacturerContractType::WARRANTY->name => 'Garantia',
    ManufacturerContractType::SUPPORT->name => 'Apoio',
    ManufacturerContractType::NONE->name => 'Sem Garantia',
    ControlType::ACCEPT->name => "Aceitar",
    ControlType::MITIGATE->name => "Mitigar",
    ControlType::TRANSFER->name => "Transferir",
    AssetOperationType::CREATE->name => "Criar Ativo",
    AssetOperationType::UPDATE->name => "Atualizar Ativo",
    AssetOperationType::ADD_THREAT->name => "Adicionar Ameaça a Ativo",
    AssetOperationType::UPDATE_THREAT->name => "Atualizar Detalhes da Ameaça do Ativo",
    AssetOperationType::REMOVE_THREAT->name => "Remover Ameaça do Ativo",
    AssetOperationType::ADD_CONTROL->name => "Adicionar Controlo a Ameaça do Ativo",
    AssetOperationType::REMOVE_CONTROL->name => "Remover Controlo da Ameaça do Ativo",
    AssetOperationType::TOGGLE_CONTROL_VALIDATION->name => "Mudar estado de validação do Controlo da Ameaça do Ativo",
    AssetOperationType::TOGGLE_REMAINING_RISK_ACCEPTANCE->name => "Mudar estado da aceitação do risco remanescente do Ativo",

];
