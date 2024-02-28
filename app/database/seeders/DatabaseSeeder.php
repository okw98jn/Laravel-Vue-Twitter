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
        User::factory(10)->has(Tweet::factory(100))->create();

        User::factory()->has(Tweet::factory(100))->create([
            'user_id'      => '@user1',
            'name'         => '名前',
            'introduction' => '自己紹介',
            'location'     => '日本/大阪',
            'birthday'     => '1997-09-08',
            'email'        => 'test@example.com',
            'password'     => Hash::make('1234'),
        ]);

        User::factory()->has(Tweet::factory(100))->create([
            'user_id'      => '@user2',
            'name'         => '名前2',
            'introduction' => '自己紹介2',
            'location'     => '日本/大阪',
            'birthday'     => '1997-09-08',
            'email'        => 'test2@example.com',
            'password'     => Hash::make('1234'),
        ]);
    }
}
