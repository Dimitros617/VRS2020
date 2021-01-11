<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateLoansHistory extends Migration
{
    public function up()
    {
        Schema::create('loans_history', function (Blueprint $table) {

            $table->id();
            $table->string('user');
            $table->string('name');
            $table->string('surname');
            $table->string('phone');
            $table->string('email');
            $table->string('item');
            $table->string('categories');
            $table->string('note');
            $table->string('place');
            $table->string('inventory_number');
            $table->string('rent_from');
            $table->string('rent_to');


        });
    }


}
