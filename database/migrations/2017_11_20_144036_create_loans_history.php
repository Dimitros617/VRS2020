<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateLoans_History extends Migration
{
    public function up()
    {
        Schema::create('loans_history', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->string('rent_from');
            $table->string('rent_to');

           $table->foreign('id_user')->references('id')->on('users');


        });
    }


}

