<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKlantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('klants', function (Blueprint $table) {
            $table->id();
            $table->string('naam');
            $table->string('adres');
            $table->string('woonplaats');
            $table->string('telefoonnummer');
            $table->string('emailadres')->unique();
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
        Schema::dropIfExists('klants');
    }
}
