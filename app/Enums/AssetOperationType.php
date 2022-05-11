<?php

namespace App\Enums;
enum AssetOperationType: string
{
    case CREATE = "CREATE";
    case UPDATE = "UPDATE";
    case ADD_THREAT = "ADD_THREAT";
    case UPDATE_THREAT = "UPDATE_THREAT";
    case REMOVE_THREAT = "REMOVE_THREAT";
    case ADD_CONTROL = "ADD_CONTROL";
    case REMOVE_CONTROL = "REMOVE_CONTROL";
    case TOGGLE_CONTROL_VALIDATION = "TOGGLE_CONTROL_VALIDATION";
    case TOGGLE_REMAINING_RISK_ACCEPTANCE = "TOGGLE_REMAINING_RISK_ACCEPTANCE";

}
