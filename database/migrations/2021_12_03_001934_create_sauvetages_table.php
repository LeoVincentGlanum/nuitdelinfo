<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSauvetagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sauvetages', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('titre');
            $table->integer('nbPersonneSauve')->nullable();
            $table->integer('nbPersonneDecede')->nullable();
            $table->string('dureeSortiEnMer')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('sauvetages');
    }
}
