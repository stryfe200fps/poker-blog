<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvent2ChipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_chips', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('player_id');
            $table->foreignId('event_report_id')->nullable()->constrained()->cascadeOnDelete();
            $table->integer('current_chips')->default(0);
            $table->foreignId('event_payout_id')->nullable();
            $table->integer('rank')->nullable();
            $table->integer('chips_before')->default(0);
            $table->boolean('is_whatsapp')->default(0);
            $table->dateTime('date_published');
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
        Schema::dropIfExists('event_chips');
    }
}
