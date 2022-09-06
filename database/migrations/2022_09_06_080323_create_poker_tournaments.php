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
        Schema::create('poker_tournaments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->dateTime('date_start');
            $table->dateTime('date_end');
            $table->foreignId('poker_tour_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poker_tournaments');
    }
};
