<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\LinesOfCode\Counter;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\Category::factory(3)->create();
        // \App\Models\Product::factory(16)->create();
        // \App\Models\User::create([
        //     'name' => 'Adnan',
        //     'email' => 'example@gmail.com',
        //     'role' => 'admin',
        //     'password' => Hash::make('test123'),
        // ]);

        // \App\Models\User::create([
        //     'name' => 'Buyer',
        //     'email' => 'buyer@gmail.com',
        //     'password' => Hash::make('test123'),
        // ]);
        $this->call(CouriersTableSeeder::class);
        // $this->call(LocationsTableSeeder::class);
    }
}
