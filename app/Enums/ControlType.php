<?php

namespace App\Enums;
enum ControlType: string
{
    case MITIGATE = "MITIGATE";
    case TRANSFER = "TRANSFER";
    case ACCEPT = "ACCEPT";
}
