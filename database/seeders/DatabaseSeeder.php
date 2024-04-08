<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // User::factory()->create([
        //     'id' => 0,
        //     'name' => 'Admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('admin123'),
        // ]);
        User::create([
            'id' => 0,
            'name' => 'Admin',
            'password' => '12345678',
            'email' => 'admin@gmail.com',
        ]);
    }
}
