<?php

namespace App\Models;

use App\Enums\AssetOperationType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssetLog extends Model
{
    protected $fillable = [
        "asset_id",
        "user_id",
        "ip",
        "operation_type"
    ];
    protected $casts = [
        'operation_type' => AssetOperationType::class,
    ];

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
