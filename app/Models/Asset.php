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
    //fixme novo controlador logs -> tabs para cada tipo logs -> com paginacao log asset : pesquisa tipo operacao e id asset
    //log asset : data, operacao, asset, responsavel (operacao), ip
    //fixme logs em BD APENAS para asset e ficheiro texto para todos os outros (incluindo asset)
    //data:ip:utilizador:ADICIONAR AMEACA (ID:X) A ATIVO(Y)
    //fixme readme passos instalacao
    //fixme no grafico de dependencias, quadrados estao colorizados pelo seu risco final, e formas para asset type com legenda canto inferior, IP, fqdn, asset type
    //fixme adicionar fqdn
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
        return max($this->threats()->pluck("residual_risk")->toArray());
    }
    //fixme adicionar boolean remainingRiskAccepted -> botao num novo separador:
    /**
     * Tabela com todas ameacas e risco remanescente apos aplicar controlos -> associado a ativo A tabela: nome ameaca, descricao, total disk, remaining risk -> botao accept all remaining risk
     */
}
