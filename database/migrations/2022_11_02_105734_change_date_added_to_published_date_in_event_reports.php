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
        // try { 
        // Schema::table('event_reports', function (Blueprint $table) {
        //   $table->renameColumn('date_added', 'published_date');
        // });
        //  } catch (Exception $e    ) { }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('event_reports', function (Blueprint $table) {
        //     $table->renameColumn('published_date', 'date_added');
        // });
    }
};
