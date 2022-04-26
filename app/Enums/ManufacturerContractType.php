<?php
namespace App\Enums;
enum ManufacturerContractType : string
{
    case WARRANTY = "WARRANTY";
    case MAINTENANCE = "MAINTENANCE";
    case SUPPORT = "SUPPORT";
    case NONE = "NONE";

}
