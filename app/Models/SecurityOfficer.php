<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecurityOfficer extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity_name',
        'name',
        'role',
        'email_address',
        'landline_phone_number',
        'mobile_phone_number',
    ];
}
