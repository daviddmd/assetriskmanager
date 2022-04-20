<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermanentContactPoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity_name',
        'permanent_contact_point_name',
        'main_email_address',
        'secondary_email_address',
        'main_landline_phone_number',
        'secondary_landline_phone_number',
        'main_mobile_phone_number',
        'secondary_mobile_phone_number',
        'other_alternative_contacts',
    ];
}
