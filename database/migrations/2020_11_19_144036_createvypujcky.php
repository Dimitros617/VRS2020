<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateVypujcky extends Migration
{
    public function up()
    {
        Schema::create('vypujcky', function (Blueprint $table) {

            $table->id();
            $table->integer('uzivatel');
            $table->integer('item');
            $table->timestamp('vypujceno_od')->useCurrent();
            $table->timestamp('vypujceno_do')->useCurrent();
            $table->tinyInteger('stav')->default('1');



        });
    }


}

