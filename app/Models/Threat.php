<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Threat extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','description'
    ];
    public function controls(): HasMany
    {
        return $this->hasMany(Control::class);
    }
}
