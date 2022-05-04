<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AssetThreat extends Pivot
{
    //fixme métodos: all controls validated? -> definir e aceitar risco restante;
    protected $fillable = [
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
        return $this->belongsToMany(Control::class, "asset_threat_control", "asset_threat_id")->using(AssetThreatControl::class)->withPivot("validated", "control_type","id");
    }

    public function availableControls()
    {
        return DB::table("controls")->whereNotIn("control_id", $this->controls()->pluck("control_id")->toArray())->join("control_threat", "control_threat.control_id", "=", "controls.id")->where("control_threat.threat_id", "=", $this->threat_id)->get();
    }
}
