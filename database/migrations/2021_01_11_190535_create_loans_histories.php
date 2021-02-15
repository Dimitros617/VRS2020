<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateLoansHistories extends Migration
{
    public function up()
    {
        Schema::create('loans_histories', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('userId');
            $table->string('nick');
            $table->string('name');
            $table->string('surname');
            $table->string('phone');
            $table->string('email');
            $table->unsignedBigInteger('itemId');
            $table->string('item');
            $table->unsignedBigInteger('categoryId');
            $table->string('categories');
            $table->string('note');
            $table->string('place');
            $table->string('inventory_number');
            $table->date('rent_from');
            $table->date('rent_to');
            $table->timestamp('created');


        });
    }


}
