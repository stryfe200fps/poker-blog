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
            Schema::table('articles', function (Blueprint $table) {
                $table->text('description');
            });
        } catch (Exception $e) {
        }
        try {
            DB::statement('ALTER TABLE `articles` MODIFY COLUMN `created_at` DATE AFTER `description`');
            DB::statement('ALTER TABLE `articles` MODIFY COLUMN `updated_at` DATE AFTER `created_at`');
            DB::statement('ALTER TABLE `articles` MODIFY COLUMN `content` TEXT AFTER `title`');
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
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
};
