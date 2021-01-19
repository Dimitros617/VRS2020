<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Createmessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('from_user_id')->nullable();
            $table->string('messages',3000)->default('');
            $table->tinyInteger('priority',)->default('0');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('from_user_id')->references('id')->on('users');

        });
    }
}
