<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bestelregel extends Model
{
    use HasFactory;

    protected $fillable = ['aantal', 'afmeting', 'regelprijs', 'bestelling_id', 'pizza_id'];

    public function bestelling()
    {
        return $this->belongsTo(Bestelling::class);
    }

    public function pizza()
    {
        return $this->belongsTo(Pizza::class);
    }
}
