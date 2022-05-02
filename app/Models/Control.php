<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Control extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description'
    ];

    public function threats(): BelongsToMany
    {
        return $this->belongsToMany(Threat::class);
    }
}
