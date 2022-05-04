<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function assets(): BelongsToMany
    {
        return $this->belongsToMany(Asset::class)->using(AssetThreat::class);
    }
}
