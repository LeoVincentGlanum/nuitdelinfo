<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSauveteursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sauveteurs', function (Blueprint $table) {
            $table->id();
            $table->date('dateNaissance')->nullable();
            $table->date('dateDeMort')->nullable();
            $table->string('titre')->nullable();
            $table->string('nom');
            $table->string('prenom')->nullable();
            $table->integer('nbSortieEnMer')->nullable();
            $table->integer('nbPersonneSauve')->nullable();
            $table->text('description')->nullable();
            $table->text('etatCivile')->nullable();
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
        Schema::dropIfExists('sauveteurs');
    }
}
