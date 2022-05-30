<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name"=>"Thin Kabyar",
            "email"=>"thinkabyaroo@gmail.com",
            "password"=>Hash::make('password')
        ]);
        User::create([
            "name"=>"WinWinMaw",
            "email"=>"wwm@gmail.com",
            "password"=>Hash::make('password')
        ]);

        \App\Models\User::factory(10)->create();
        Category::factory(5)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
