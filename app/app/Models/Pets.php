<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pets extends Model
{
    use HasFactory;

    public function gallery() : HasOne
    {
        return $this->hasOne(Gallery_pets::class);
    }

    public function notify() : HasOne
    {
        return $this->hasOne(Notify_pets::class);
    }

    public function species() : HasOne
    {
        return $this->hasOne(Species::class);
    }

    public function address() : HasOne
    {
        return $this->hasOne(Address_pets::class);
    }

    protected $fillable = [
        'name',
        'weight',
        'size',
        'age',
        'desc_pets',
        'status'
    ];
}
