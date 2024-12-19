<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klant extends Model
{
    use HasFactory;

    protected $fillable = ['naam', 'adres', 'woonplaats', 'telefoonnummer', 'emailadres'];

    public function bestellingen()
    {
        return $this->hasMany(Bestelling::class);
    }
}
