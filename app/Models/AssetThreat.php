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

    /**
     * @param $score
     * @return string
     * Used to calculate the color of cells on tables for values such as impacts and probability
     */
    public static function color($score): string
    {
        return match ($score) {
            1 => config("constants.colors.green"),
            2 => config("constants.colors.blue"),
            3 => config("constants.colors.yellow"),
            4 => config("constants.colors.orange"),
            5 => config("constants.colors.red"),
            default => config("constants.colors.white"),
        };
    }

    public static function totalRiskColor($score): string
    {
        return self::absoluteRiskColor($score / 5);
    }

    public static function absoluteRiskColor($score): string
    {
        if ($score > 0 && $score <= 5) {
            return config("constants.colors.green");
        } elseif ($score > 5 && $score <= 10) {
            return config("constants.colors.blue");
        } elseif ($score > 10 && $score <= 15) {
            return config("constants.colors.yellow");
        } elseif ($score > 15 && $score <= 20) {
            return config("constants.colors.orange");
        } elseif ($score > 20 && $score <= 25) {
            return config("constants.colors.red");
        }
        return config("constants.colors.white");
    }

    public function totalRisk($assetAppreciation): float|int
    {
        return $this->absoluteRisk() * $assetAppreciation;
    }

    public function absoluteRisk(): float|int
    {
        return max([$this->confidentiality_impact, $this->availability_impact, $this->integrity_impact]) * $this->probability;
    }

    public function threat(): BelongsTo
    {
        return $this->belongsTo(Threat::class, "threat_id");
    }

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class, "asset_id");
    }

    public function availableControls()
    {
        return Control::whereNotIn("id", $this->controls()->pluck("control_id")->toArray())->
        whereIn("id", ControlThreat::where("threat_id", "=", $this->threat_id)->pluck("control_id")->toArray())->
        get();
    }

    public function controls()
    {
        return $this->hasMany(AssetThreatControl::class);
    }
}
