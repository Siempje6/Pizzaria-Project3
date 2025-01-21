<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ingrediënt;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ingrediënt::create(['naam' => 'Tomaat', 'prijs' => 1.50]);
        Ingrediënt::create(['naam' => 'Mozzarella', 'prijs' => 2.00]);
        Ingrediënt::create(['naam' => 'Basilicum', 'prijs' => 1.20]);
        Ingrediënt::create(['naam' => 'Pepperoni', 'prijs' => 2.50]);
        Ingrediënt::create(['naam' => 'Champignons', 'prijs' => 1.80]);
        Ingrediënt::create(['naam' => 'Paprika', 'prijs' => 1.50]);
        Ingrediënt::create(['naam' => 'Olijven', 'prijs' => 2.00]);
        Ingrediënt::create(['naam' => 'Ananas', 'prijs' => 1.80]);
        Ingrediënt::create(['naam' => 'Jalapeños', 'prijs' => 1.70]);
        Ingrediënt::create(['naam' => 'Ui', 'prijs' => 1.00]);
        Ingrediënt::create(['naam' => 'Parmezaanse kaas', 'prijs' => 2.20]);
        Ingrediënt::create(['naam' => 'Salami', 'prijs' => 2.50]);
        Ingrediënt::create(['naam' => 'Spek', 'prijs' => 2.60]);
        Ingrediënt::create(['naam' => 'Kip', 'prijs' => 2.40]);
        Ingrediënt::create(['naam' => 'Knoflook', 'prijs' => 1.30]);
        Ingrediënt::create(['naam' => 'Spinazie', 'prijs' => 1.60]);
        Ingrediënt::create(['naam' => 'Artisjok', 'prijs' => 2.30]);
        Ingrediënt::create(['naam' => 'Truffelolie', 'prijs' => 3.00]);
        Ingrediënt::create(['naam' => 'Pijnboompitten', 'prijs' => 2.80]);
        Ingrediënt::create(['naam' => 'Rucola', 'prijs' => 1.90]);
        Ingrediënt::create(['naam' => 'Chili flakes', 'prijs' => 1.50]);
        Ingrediënt::create(['naam' => 'Zongedroogde tomaten', 'prijs' => 2.10]);
        Ingrediënt::create(['naam' => 'Feta', 'prijs' => 2.30]);
        Ingrediënt::create(['naam' => 'Geitenkaas', 'prijs' => 2.40]);
        Ingrediënt::create(['naam' => 'Gorgonzola', 'prijs' => 2.50]);
        Ingrediënt::create(['naam' => 'Tuna', 'prijs' => 2.80]);
        Ingrediënt::create(['naam' => 'Rode ui', 'prijs' => 1.20]);
    }
}
