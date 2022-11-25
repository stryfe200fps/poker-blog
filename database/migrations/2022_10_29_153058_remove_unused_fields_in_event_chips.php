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

            // $table->dateTime('published_date');
            $table->dropColumn([
                'name',
                // 'date_published'
            ]);
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
            $table->string('name');
            // $table->dateTime('date_published');

        });
    }
};
