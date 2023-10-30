<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notify_pets extends Model
{
    use HasFactory;

    public function pets() : BelongsTo
    {
        return $this->belongsTo(Pets::class);
    }

    protected $fillable = [
        'name',
        'cpf',
        'email',
        'phone',
        'dt_birth',
        'pets_id'
    ];
}
