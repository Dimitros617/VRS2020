<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->float('price', 8, 2)->default(0.00)->after('place');
            $table->unsignedBigInteger('responsible_user_id')->nullable()->after('id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('responsible_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign(['responsible_user_id']);
            $table->dropColumn('price');
            $table->dropColumn('responsible_user_id');
            $table->dropSoftDeletes();           
        });
    }
}
