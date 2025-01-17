<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bestelling extends Model
{
    use HasFactory;

    protected $fillable = [
        'klant_id', 'datum', 'totaalprijs', 'status',
    ];

    public function klant()
    {
        return $this->belongsTo(User::class, 'klant_id');
    }

    public function bestelregels()
    {
        return $this->hasMany(Bestelregel::class);
    }
}

