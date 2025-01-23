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
        'afbeelding',
    ];

    protected static function booted()
    {
        static::created(function ($pizza) {
            $sizes = [
                ['size' => 'small', 'price' => 8.99],
                ['size' => 'medium', 'price' => 10.99],
                ['size' => 'large', 'price' => 12.99],
            ];

            foreach ($sizes as $size) {
                PizzaSize::create([
                    'pizza_id' => $pizza->id,
                    'size' => $size['size'],
                    'price' => $size['price'],
                ]);
            }
        });
    }
    public function ingredients()
    {
        return $this->belongsToMany(Ingrediënt::class, 'pizza_ingrediënt');
    }

    public function bestelregels()
    {
        return $this->hasMany(Bestelregel::class);
    }

    public function sizes()
    {
        return $this->hasMany(PizzaSize::class);
    }
}
