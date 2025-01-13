<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingrediënt extends Model
{
    use HasFactory;

    protected $table = 'ingrediënten';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'naam',
    ];

    public function pizzas()
    {
        return $this->belongsToMany(Pizza::class, 'pizza_ingrediënt');
    }
}
