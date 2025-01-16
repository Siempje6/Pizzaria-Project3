<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    use HasFactory;

    protected $table = 'pizzas';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'naam',
        'prijs',
        'afbeeldingen',
    ];

    public function ingredients()
    {
        return $this->belongsToMany(Ingrediënt::class, 'pizza_ingrediënt');
    }

    public function bestelregels()
    {
        return $this->hasMany(Bestelregel::class);
    }
}
