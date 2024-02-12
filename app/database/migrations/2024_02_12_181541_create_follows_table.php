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
        Schema::create('follows', function (Blueprint $table) {
            $table->foreignId('follower_id')->constrained('users')->onDelete('cascade')->comment('フォローするユーザーID');
            $table->foreignId('followed_id')->constrained('users')->onDelete('cascade')->comment('フォローされるユーザーID');

            $table->unique(['follower_id', 'followed_id']);
            $table->comment('フォロー/フォロワーを管理');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follows');
    }
};
