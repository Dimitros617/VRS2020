<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreatePermition extends Migration
{
    public function up()
    {
        Schema::create('permition', function (Blueprint $table) {

            $table->id();
            $table->string('nazev',40);
            $table->tinyInteger('moznost_vypujcky',)->default('0');
            $table->tinyInteger('novy_uzivatele',)->default('0');
            $table->tinyInteger('overeni_vraceni',)->default('0');
            $table->tinyInteger('uprava_itemu',)->default('0');



        });
    }
}
