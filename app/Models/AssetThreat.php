<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssetThreat extends Model
{
    protected $fillable = [
        "asset_id",
        "threat_id",
        "probability",
        "confidentiality_impact",
        "availability_impact",
        "integrity_impact",
        "residual_risk",
        "residual_risk_accepted",
    ];

    public function color($score): string
    {
        return match ($score) {
            1 => "green",
            2 => "dodgerblue",
            3 => "yellow",
            4 => "orange",
            5 => "red",
            default => "white",
        };
    }

    public function absoluteRiskColor($score): string
    {
        if ($score >= 0 && $score <= 5) {
            return "green";
        }
        elseif ($score > 5 && $score <= 10) {
            return "dodgerblue";
        }
        elseif ($score > 10 && $score <= 15) {
            return "yellow";
        }
        elseif ($score > 15 && $score <= 20) {
            return "orange";
        }
        elseif ($score > 20 && $score <= 25) {
            return "red";
        }
        return "white";
    }

    public function absoluteRisk(): float|int
    {
        return max([$this->confidentiality_impact, $this->availability_impact, $this->integrity_impact]) * $this->probability;
    }

    public function controls()
    {
        return $this->hasMany(AssetThreatControl::class);
    }

    public function threat(): BelongsTo
    {
        return $this->belongsTo(Threat::class, "threat_id");
    }

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class, "asset_id");
    }
    public function totalRisk($assetAppreciation): float|int
    {
        return $this->absoluteRisk()*$assetAppreciation;
    }
    public function availableControls()
    {
        return Control::whereNotIn("id", $this->controls()->pluck("control_id")->toArray())->
        whereIn("id", ControlThreat::where("threat_id", "=", $this->threat_id)->pluck("control_id")->toArray())->
        get();
    }
}
