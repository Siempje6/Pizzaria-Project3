<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bestelling extends Model
{
    use HasFactory;

    protected $fillable = ['datum', 'status', 'totaalprijs', 'klant_id'];

    public function klant()
    {
        return $this->belongsTo(Klant::class);
    }

    public function bestelregels()
    {
        return $this->hasMany(Bestelregel::class);
    }
}
