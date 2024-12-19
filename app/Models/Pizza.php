<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    use HasFactory;

    protected $fillable = ['naam', 'prijs'];

    public function ingrediënten()
    {
        return $this->belongsToMany(Ingrediënt::class, 'pizza_ingrediënt');
    }

    public function bestelregels()
    {
        return $this->hasMany(Bestelregel::class);
    }
}
