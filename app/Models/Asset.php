<?php

namespace App\Models;

use App\Enums\ManufacturerContractType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        "ip_address",
        "availability_appreciation",
        "integrity_appreciation",
        "confidentiality_appreciation",
        "export",
        "active",
        "links_to_id"
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'manufacturer_contract_type'=>ManufacturerContractType::class,
    ];
    public function type()
    {
        return $this->belongsTo(AssetType::class,"asset_type_id");
    }
    public function manager()
    {
        return $this->belongsTo(User::class,"manager_id","id");
    }
    public function totalAppreciation(){
        return max([$this->availability_appreciation,$this->integrity_appreciation,$this->confidentiality_appreciation]);
    }
    //fixme função idêntica para calcular a cor dos riscos num assetrisk
    /*
     *         if ($score >= 0 && $score < 1){
            return "white";
        }
        elseif ($score >= 1 && $score < 2){
            return "green";
        }
        elseif ($score >= 2 && $score < 3){
            return "blue";
        }
        elseif ($score >= 3 && $score < 4){
            return "yellow";
        }
        elseif ($score >= 4 && $score < 5){
            return "orange";
        }
        else{
            return "red";
        }
     */
    public function color($score): string
    {
        return match ($score) {
            1 => "green",
            2 => "blue",
            3 => "yellow",
            4 => "orange",
            5 => "red",
            default => "white",
        };

    }
    //asset that this asset connects to
    public function linksTo(): BelongsTo
    {
        return $this->belongsTo(Asset::class,"links_to_id");
    }
    //assets that connect to this asset
    public function assetsLinked(): HasMany
    {
        return $this->hasMany(Asset::class,"links_to_id");
    }
}
