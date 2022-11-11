<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['image']);
        });

           Schema::table('tournaments', function (Blueprint $table) {
            $table->dropColumn(['image']);
        });

              Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['image']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('image');
        });

           Schema::table('tournaments', function (Blueprint $table) {
            $table->string('image');
        });

            Schema::table('articles', function (Blueprint $table) {
            $table->string('image');
        });
    }
};
