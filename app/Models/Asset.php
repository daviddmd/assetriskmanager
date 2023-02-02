<?php

namespace App\Models;

use App\Enums\ManufacturerContractType;
use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'asset_type_id',
        "manager_id",
        "description",
        "sku",
        "manufacturer",
        "location",
        "manufacturer_contract_type",
        "manufacturer_contract_beginning_date",
        "manufacturer_contract_ending_date",
        "manufacturer_contract_provider",
        "mac_address",
        "fqdn",
        "ip_address",
        "availability_appreciation",
        "integrity_appreciation",
        "confidentiality_appreciation",
        "export",
        "active",
        "links_to_id",
        "remainingRiskAccepted",
        "version"
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'manufacturer_contract_type' => ManufacturerContractType::class,
    ];

    /**
     * @param $score
     * @return string
     * Used to calculate the color of the cells on the tables for values such as appreciation
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

    public function type()
    {
        return $this->belongsTo(AssetType::class, "asset_type_id");
    }

    public function manager()
    {
        return $this->belongsTo(User::class, "manager_id", "id");
    }

    /**
     * @return BelongsTo Asset that this asset connects to
     */
    public function linksTo(): BelongsTo
    {
        return $this->belongsTo(Asset::class, "links_to_id");
    }

    /**
     * @return HasMany Assets that connect to this asset
     */
    public function children(): HasMany
    {
        return $this->hasMany(Asset::class, "links_to_id");
    }

    public function availableThreats()
    {
        return Threat::whereNotIn("id", $this->asset->threats()->pluck("threat_id")->toArray())->get();
    }

    /**
     * @return HasMany Threats of this Asset
     */
    public function threats(): HasMany
    {
        return $this->hasMany(AssetThreat::class, "asset_id");
    }

    public function availableChildren(): array
    {
        /* @var $user User */
        $user = Auth::user();
        return array_filter($this->children->all(), function ($child) use ($user) {
            return $child->manager_id == $user->id ||
                in_array($user->role, [UserRole::SECURITY_OFFICER, UserRole::DATA_PROTECTION_OFFICER]);
        });
    }

    public function highestRemainingRisk()
    {
        $threats = $this->threats;
        $non_controlled_threats = $threats->where("residual_risk_accepted", "=", false);
        if ($non_controlled_threats->count() != 0) {
            return max($non_controlled_threats->map(function ($item) {
                    return $item->absoluteRisk();
                })->toArray()) * $this->totalAppreciation();
        }
        $controlled_threats = $threats->where("residual_risk", "!=", 0);
        return $controlled_threats->count() == 0 ? 0 : max($controlled_threats->pluck("residual_risk")->toArray());
    }

    public function totalAppreciation()
    {
        return max([$this->availability_appreciation, $this->integrity_appreciation, $this->confidentiality_appreciation]);
    }

    public function hasUnvalidatedControls(): bool
    {
        foreach ($this->threats as $threat) {
            foreach ($threat->controls as $control) {
                if (!$control->validated) {
                    return true;
                }
            }
        }
        return false;
    }

    public function logs(): HasMany
    {
        return $this->hasMany(AssetLog::class);
    }
}
