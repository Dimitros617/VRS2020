<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterLoansHistoriesTableCorrectLength extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loans_histories', function (Blueprint $table) {
            $table->string('name',50)->change();
            $table->string('surname',50)->change();
            $table->string('phone',16)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loans_histories', function (Blueprint $table) {
            $table->string('name',255)->change();
            $table->string('surname',255)->change();
            $table->string('phone',255)->change();
        });
    }
}
