<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address_pets extends Model
{
    use HasFactory;

    protected $fillable = [
        'city',
        'state',
        'country',
        'cep',
        'street',
        'neighborhood',
        'number',
        'pets_id'
    ];
}
