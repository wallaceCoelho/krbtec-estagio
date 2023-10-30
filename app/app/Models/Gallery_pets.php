<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gallery_pets extends Model
{
    use HasFactory;

    public function pets() : BelongsTo
    {
        return $this->belongsTo(Pets::class);
    }

    protected $fillable = [
        'img_header',
        'img1',
        'img2',
        'img3',
        'img4',
        'pets_id'
    ];
}
