<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPublishColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->dateTime('published_at')->nullable();
            $table->uuid('published_id')->nullable()->unique();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_publishable')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->dropColumn(['published_at', 'published_id']);
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_publishable');
        });
    }
}
