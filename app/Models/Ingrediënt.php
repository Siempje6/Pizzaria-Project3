<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingrediënt extends Model
{
    use HasFactory;

    protected $fillable = ['naam', 'prijs'];

    public function pizzas()
    {
        return $this->belongsToMany(Pizza::class, 'pizza_ingrediënt');
    }
}
