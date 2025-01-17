<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class pizzasizeseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pizza_sizes')->insert([
            ['pizza_id' => 1, 'size' => 'small', 'price' => 8.99],
            ['pizza_id' => 1, 'size' => 'medium', 'price' => 10.99],
            ['pizza_id' => 1, 'size' => 'large', 'price' => 12.99],
        ]);
        
    }
}
