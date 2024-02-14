<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->comment('ユーザーID');
            $table->foreignId('tweet_id')->constrained('tweets')->onDelete('cascade')->comment('ツイートID');

            $table->unique(['user_id', 'tweet_id']);
            $table->comment('ブックマーク');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookmarks');
    }
};
