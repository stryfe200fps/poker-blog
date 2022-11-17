<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Grammars\RenameColumn;
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
           $table->renameColumn('date_published', 'published_date');
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
            $table->renameColumn('published_date', 'date_published');
        });
        } catch (Exception $e) { }
    }
};
