<?php

namespace App\Models;

use App\Enums\ControlType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AssetThreatControl extends Model
{
    protected $fillable = [
        "asset_threat_id",
        "control_id",
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

    public function asset_threat()
    {
        return $this->belongsTo(AssetThreat::class);
    }

    public function control()
    {
        return $this->belongsTo(Control::class, "control_id");
    }
}
