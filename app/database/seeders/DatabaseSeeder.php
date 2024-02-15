<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->has(Tweet::factory(10))->create();

        User::factory()->has(Tweet::factory(10))->create([
            'user_id'      => '@user12345678',
            'name'         => '名前',
            'introduction' => '自己紹介',
            'location'     => '日本/大阪',
            'birthday'     => '1997年09月08日',
            'email'        => 'test@example.com',
            'password'     => Hash::make('1234'),
        ]);
    }
}
