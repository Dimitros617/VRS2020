<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('jmeno_uzivatele',40);
            $table->string('prijmeni_uzivatele',40);
            $table->string('heslo',40);
            $table->integer('telefon');
            $table->string('email',40);
            $table->tinyInteger('verify')->default('0');
            $table->unsignedBigInteger('permition');

            $table->foreign('permition')->references('id')->on('permition');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
