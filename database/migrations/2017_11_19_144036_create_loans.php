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
            $table->unsignedBigInteger('item');
            $table->timestamp('rent_from')->useCurrent();
            $table->timestamp('rent_to')->useCurrent();
            $table->tinyInteger('status')->default('1');

           $table->foreign('user')->references('id')->on('users');
           $table->foreign('item')->references('id')->on('items');



        });
    }


}

