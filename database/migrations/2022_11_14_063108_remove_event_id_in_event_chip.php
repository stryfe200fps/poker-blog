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
        Schema::table('event_chips', function (Blueprint $table) {
            $table->dropColumn(['event_id']);
        });
        } catch (Exception $e) { }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        try { 
        Schema::table('event_chips', function (Blueprint $table) {
            $table->foreignId('event_id');
        });
    } catch (Exception $e) { }
    }
};
