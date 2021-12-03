<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBateauSauveteursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bateau_sauveteurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('constructeur')->nullable();
            $table->date('commande')->nullable();
            $table->string('type')->nullable();
            $table->string('dimensions')->nullable();
            $table->string('installation')->nullable();
            $table->date('finDeService')->nullable();
            $table->integer('nbDeSortieEnMer')->nullable();
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
        Schema::dropIfExists('bateau_sauveteurs');
    }
}
