<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBestellingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bestellings', function (Blueprint $table) {
            $table->id();
            $table->date('datum');
            $table->enum('status', ['Initieel', 'Betaald', 'Bereiden', 'InOven', 'Onderweg', 'Bezorgd']);
            $table->decimal('totaalprijs', 8, 2);

            $table->unsignedBigInteger('klant_id');
            $table->foreign('klant_id')->references('id')->on('klants');
            
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
        Schema::dropIfExists('bestellings');
    }
}

