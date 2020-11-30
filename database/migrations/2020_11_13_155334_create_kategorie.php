<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateKategorie extends Migration
{
    public function up()
    {
        Schema::create('kategorie', function (Blueprint $table) {
            $table->id();
            $table->string('nazev',90);
            $table->text('popis');

        });
    }


}
