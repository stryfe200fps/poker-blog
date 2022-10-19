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
        Schema::table('event_chips', function (Blueprint $table) {

            $table->dropColumn([
                'rank',
                'chips_before',
                'event_id'
            ]);

            $table->foreignId('day_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_chips', function (Blueprint $table) {

            $table->foreignId('event_id');
            $table->integer('rank')->nullable();
            $table->integer('chips_before')->default(0);

            $table->dropColumn([
                'day_id',
            ]);
            
        });
    }
};
