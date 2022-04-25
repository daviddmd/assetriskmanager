<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Control extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','description','threat_id'
    ];
    public function threat(): BelongsTo
    {
        return $this->belongsTo(Threat::class);
    }
}
