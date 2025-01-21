<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table('pizzas')->insert([
            [
                'id' => 1,
                'naam' => 'Pepperoni',
                'prijs' => 11.99,
                'created_at' => '2024-12-19 14:24:01',
                'updated_at' => '2024-12-19 14:24:01',
                'afbeelding' => 'images/peperoni.png',
            ],
            [
                'id' => 2,
                'naam' => 'Margherita',
                'prijs' => 9.99,
                'created_at' => '2024-12-19 14:25:13',
                'updated_at' => '2024-12-19 14:25:13',
                'afbeelding' => 'images/magerita.png',
            ],
            [
                'id' => 3,
                'naam' => 'Hawaii',
                'prijs' => 10.99,
                'created_at' => '2024-12-19 14:25:13',
                'updated_at' => '2024-12-19 14:25:13',
                'afbeelding' => 'images/hawai.png',
            ],
            [
                'id' => 4,
                'naam' => 'Quattro Formaggi',
                'prijs' => 12.99,
                'created_at' => '2024-12-19 14:26:22',
                'updated_at' => '2024-12-19 14:26:22',
                'afbeelding' => 'images/quatro.png',
            ],
            [
                'id' => 6,
                'naam' => 'Vegetariana',
                'prijs' => 11.49,
                'created_at' => '2025-01-17 12:00:00',
                'updated_at' => '2025-01-17 12:00:00',
                'afbeelding' => 'images/vegetariana.png',
            ],
            [
                'id' => 7,
                'naam' => 'BBQ Chicken',
                'prijs' => 12.49,
                'created_at' => '2025-01-17 12:05:00',
                'updated_at' => '2025-01-17 12:05:00',
                'afbeelding' => 'images/bbq_chicken.png',
            ],
            [
                'id' => 8,
                'naam' => 'Calzone',
                'prijs' => 13.49,
                'created_at' => '2025-01-17 12:10:00',
                'updated_at' => '2025-01-17 12:10:00',
                'afbeelding' => 'images/calzone.png',
            ],
            [
                'id' => 9,
                'naam' => 'Mexicana',
                'prijs' => 12.99,
                'created_at' => '2025-01-17 12:15:00',
                'updated_at' => '2025-01-17 12:15:00',
                'afbeelding' => 'images/mexicana.png',
            ],
            [
                'id' => 10,
                'naam' => 'Diavola',
                'prijs' => 13.49,
                'created_at' => '2025-01-17 12:20:00',
                'updated_at' => '2025-01-17 12:20:00',
                'afbeelding' => 'images/diavola.png',
            ],
            [
                'id' => 11,
                'naam' => 'Funghi',
                'prijs' => 10.99,
                'created_at' => '2025-01-17 12:25:00',
                'updated_at' => '2025-01-17 12:25:00',
                'afbeelding' => 'images/funghi.png',
            ],
            [
                'id' => 12,
                'naam' => 'Capricciosa',
                'prijs' => 11.99,
                'created_at' => '2025-01-17 12:30:00',
                'updated_at' => '2025-01-17 12:30:00',
                'afbeelding' => 'images/capricciosa.png',
            ],
            [
                'id' => 13,
                'naam' => 'Frutti di Mare',
                'prijs' => 14.49,
                'created_at' => '2025-01-17 12:35:00',
                'updated_at' => '2025-01-17 12:35:00',
                'afbeelding' => 'images/frutti_di_mare.png',
            ],
            [
                'id' => 14,
                'naam' => 'Provolone',
                'prijs' => 12.99,
                'created_at' => '2025-01-17 12:40:00',
                'updated_at' => '2025-01-17 12:40:00',
                'afbeelding' => 'images/provolone.png',
            ],
            [
                'id' => 15,
                'naam' => 'Napoli',
                'prijs' => 11.99,
                'created_at' => '2025-01-17 12:45:00',
                'updated_at' => '2025-01-17 12:45:00',
                'afbeelding' => 'images/napoli.png',
            ],
            [
                'id' => 16,
                'naam' => 'Siciliana',
                'prijs' => 13.99,
                'created_at' => '2025-01-17 12:50:00',
                'updated_at' => '2025-01-17 12:50:00',
                'afbeelding' => 'images/siciliana.png',
            ],
            [
                'id' => 17,
                'naam' => 'Rucola',
                'prijs' => 12.49,
                'created_at' => '2025-01-17 12:55:00',
                'updated_at' => '2025-01-17 12:55:00',
                'afbeelding' => 'images/rucola.png',
            ],
        ]);
    }
}
