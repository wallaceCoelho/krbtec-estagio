<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Breed extends Model
{
    use HasFactory;

    public function species() : BelongsTo
    {
        return $this->belongsTo(Species::class);
    }

    protected $fillable = [
        'nm_breed',
        'species_id'
    ];
}
