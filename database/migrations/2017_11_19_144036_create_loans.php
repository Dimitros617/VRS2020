<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateLoans extends Migration
{
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('user');
            $table->string('name');
            $table->string('surname');
            $table->string('phone');
            $table->string('email');
            $table->unsignedBigInteger('item');
            $table->unsignedBigInteger('categories');
            $table->string('name');
            $table->string('note');
            $table->string('place');
            $table->string('inventory_number');
            $table->string('rent_from');
            $table->string('rent_to');
            $table->tinyInteger('status')->default('1');

           $table->foreign('user')->references('id')->on('users');
           $table->foreign('item')->references('id')->on('items');



        });
    }


}

