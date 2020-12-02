<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateItems extends Migration
{
    public function up()
    {
        Schema::create('itemy', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('kategorie');
            $table->string('nazev',90);
            $table->string('poznamka',180)->default('');
            $table->string('umisteni',90);
            $table->tinyInteger('k_dispozici')->default('0');
            $table->string('inventarni_cislo',40);
            $table->integer('evidencni_cislo');
            $table->string('odpovedna_osoba',60);

            //$table->foreign('kategorie')->references('id')->on('kategorie');

        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
