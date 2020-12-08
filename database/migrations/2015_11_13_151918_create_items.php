<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateItems extends Migration
{
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('categories');
            $table->string('name',90)->default('');
            $table->string('note',180)->default('');
            $table->string('place',90)->default('');
            $table->tinyInteger('availability')->default('1');
            $table->string('inventory_number',90)->default('');

            $table->foreign('categories')->references('id')->on('categories');

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
