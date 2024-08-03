<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Tạo 100 người dùng ngẫu nhiên
        User::factory(10)->create([
            'password' => Hash::make('123456')
        ]);

        // Tạo một người dùng có email là nam@gmail.com
        User::create([
            'name' => 'Nam',
            'email' => 'nam@gmail.com',
            'password' => Hash::make('123456')
        ]);
    }
}
