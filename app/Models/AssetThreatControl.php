<?php

namespace App\Models;

use App\Enums\ControlType;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AssetThreatControl extends Pivot
{
    protected $fillable = [
        "validated",
        "control_type"
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'control_type' => ControlType::class,
    ];
}
