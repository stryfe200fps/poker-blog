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
                $table->boolean('is_whatsapp')->default(0)->change();
            });
        } catch (Exception $e) {
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_chips', function (Blueprint $table) {
            $table->boolean('is_whatsapp')->change();
        });
    }
};
