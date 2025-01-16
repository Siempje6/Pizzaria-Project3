<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bestelregel extends Model
{
    use HasFactory;

    protected $fillable = [
        'bestelling_id', 'pizza_id', 'aantal', 'regelprijs',
    ];

    public function pizza()
    {
        return $this->belongsTo(Pizza::class);
    }

    public function bestelling()
    {
        return $this->belongsTo(Bestelling::class);
    }
}

