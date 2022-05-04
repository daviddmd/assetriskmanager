<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AssetThreat extends Pivot
{
    //fixme métodos: all controls validated? -> definir e aceitar risco restante; absolute risk; final risk score;
    //fixme função idêntica para calcular a cor das ameaças num assetrisk
    protected $fillable = [
        "probability",
        "confidentiality_impact",
        "availability_impact",
        "integrity_impact",
        "residual_risk",
        "residual_risk_accepted",
    ];

    public function color($score)
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

    public function absoluteRiskColor($score)
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

    public function absoluteRisk()
    {
        return max([$this->confidentiality_impact, $this->availability_impact, $this->integrity_impact]) * $this->probability;
    }
    //fixme risco final definido na tabela para evitar lookups
}
