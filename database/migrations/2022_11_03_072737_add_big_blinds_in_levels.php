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
        Schema::table('levels', function (Blueprint $table) {
            $table->integer('big_blinds');
        });
        } catch (Exception $e ) { }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        try { 
        Schema::table('levels', function (Blueprint $table) {
            $table->dropColumn('big_blinds');
        });
    } catch (Exception $e) {}
    }
};
