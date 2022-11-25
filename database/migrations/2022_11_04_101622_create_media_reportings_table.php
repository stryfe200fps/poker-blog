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
        Schema::create('media_reportings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id');
            $table->string('type');
            $table->string('title');
            $table->string('description');
            $table->string('link');
            $table->string('published_date');
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
        Schema::dropIfExists('media_reportings');
    }
};
