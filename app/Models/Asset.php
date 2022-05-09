<?php

namespace App\Models;

use App\Enums\ManufacturerContractType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Asset extends Model
{
    /*
     * TODO logs texto para todas operações sistema: data, ip, utilizador, operação por extenso, com separador
     * TODO Controlador logs apenas para assets, com operações pelo tipo de operação, asset, order by date, responsável operação
     * TODO README/INSTALLATION com passos para instalação/configuração em ambiente dev e produção (docker/sail)
     * TODO grafo de dependências com NeoEloquent, GraphViz ou JS, nós colorizados pelo seu risco final com IP, FQDN e asset type e nome
     * TODO envio de e-mails em que circumstância?
     * TODO tradução para PT, linguagem preferida no modelo user ou cookie
     * Elementos para grafo: Nós: Asset (ID: FQDN; IP; MAC e cor do nó); Relação entre asset ID_A->ID_B
     */
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
        "remainingRiskAccepted"
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'manufacturer_contract_type' => ManufacturerContractType::class,
    ];

    public function type()
    {
        return $this->belongsTo(AssetType::class, "asset_type_id");
    }

    public function manager()
    {
        return $this->belongsTo(User::class, "manager_id", "id");
    }

    public function totalAppreciation()
    {
        return max([$this->availability_appreciation, $this->integrity_appreciation, $this->confidentiality_appreciation]);
    }

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

    public function threats(): HasMany
    {
        return $this->hasMany(AssetThreat::class, "asset_id");
    }

    public function availableThreats()
    {
        return Threat::whereNotIn("id", $this->asset->threats()->pluck("threat_id")->toArray())->get();
    }

    public function highestRemainingRisk()
    {
        $residual_risks = $this->threats()->get()->pluck("residual_risk")->toArray();
        return empty($residual_risks) ? 0 : max($residual_risks);
    }
}
