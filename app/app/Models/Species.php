<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Species extends Model
{
    use HasFactory;

    public function breed() : HasOne
    {
        return $this->HasOne(Breed::class);
    }

    public function pets() : HasOne
    {
        return $this->HasOne(Pets::class);
    }

    protected $fillable = [
        'nm_species'
    ];
}
