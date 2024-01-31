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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_id', 50)->unique()->comment('ユーザーID');
            $table->string('name', 50)->comment('ユーザー名');
            $table->string('email')->unique()->comment('メールアドレス');
            $table->string('introduction', 160)->nullable()->comment('自己紹介');
            $table->string('location', 30)->nullable()->comment('場所');
            $table->date('birthday')->comment('生年月日');
            $table->string('icon_image')->nullable()->comment('アイコン画像');
            $table->string('header_image')->nullable()->comment('ヘッダー画像');
            $table->string('password')->comment('パスワード');
            $table->timestamps();
            $table->comment('ユーザー');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
