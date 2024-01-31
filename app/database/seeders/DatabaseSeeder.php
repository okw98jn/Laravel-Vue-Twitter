<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(100)->create();

        \App\Models\User::factory()->create([
            'user_id'      => 'user1',
            'name'         => '名前',
            'introduction' => '自己紹介',
            'location'     => '日本/大阪',
            'birthday'     => '1997-09-08',
            'email'        => 'test@example.com',
            'icon_image'   => 'https://placehold.jp/150x150.png',
            'header_image' => 'https://placehold.jp/150x150.png',
            'password'     => Hash::make('1234'),
        ]);
    }
}
