<?php

namespace Database\Seeders;

use App\Models\PizzaSize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PizzaSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PizzaSize::create(['pizza_id' => 1, 'size' => 'small', 'price' => 8.99]);
        PizzaSize::create( ['pizza_id' => 1, 'size' => 'medium', 'price' => 10.99]);
        PizzaSize::create(['pizza_id' => 1, 'size' => 'large', 'price' => 12.99]);
        
    }
}
