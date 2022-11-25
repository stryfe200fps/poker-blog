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
            Schema::dropIfExists('lives');
            Schema::dropIfExists('event_payouts_original');
            Schema::dropIfExists('event_chip_event_report');
            Schema::dropIfExists('cache');
            Schema::dropIfExists('article_tags');
            Schema::dropIfExists('article_article_tag');
            Schema::dropIfExists('websockets_statistics_entries');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
