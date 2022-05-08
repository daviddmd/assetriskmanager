<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Threat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description'
    ];

    public function controls(): BelongsToMany
    {
        return $this->belongsToMany(Control::class);
    }

    public function assets(): HasMany
    {
        return $this->hasMany(AssetThreat::class,"threat_id");
        //return $this->belongsToMany(Asset::class)->using(AssetThreat::class);
    }
}
