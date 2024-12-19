<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBestelregelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bestelregels', function (Blueprint $table) {
            $table->id();
            $table->integer('aantal');
            $table->enum('afmeting', ['Klein', 'Normaal', 'Groot']);
            $table->decimal('regelprijs', 8, 2);

            $table->unsignedBigInteger('bestelling_id');
            $table->foreign('bestelling_id')->references('id')->on('bestellings');

            $table->unsignedBigInteger('pizza_id');
            $table->foreign('pizza_id')->references('id')->on('pizzas');

            $table->timestamps();



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bestelregels');
    }
}
