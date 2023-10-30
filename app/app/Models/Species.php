<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Species extends Model
{
    use HasFactory;

    public function pets() : BelongsTo
    {
        return $this->belongsTo(Pets::class);
    }

    protected $fillable = [
        'nm_species',
        'pets_id',
    ];
}
