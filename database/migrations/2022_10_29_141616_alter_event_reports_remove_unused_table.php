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
        try { 
        Schema::table('event_reports', function (Blueprint $table) {
            $table->dropColumn(['players','user_id', 'event_id']);
            // $table->string('code')->nullable()->change();
        });
        } catch (Exception $e) {

        }
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_reports', function (Blueprint $table) {
            $table->string('players')->nullable();
            // $table->dateTime('date_added');
            $table->foreignId('user_id')->nullable();
            $table->foreignId('event_id')->nullable();
        });
    }
};
