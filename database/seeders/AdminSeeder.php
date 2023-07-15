<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('0000'),
            'phone_number' => '0798898678',
            'role' => 'admin',
            'first_login' => false
        ]);

       $user = User::create([
            'name' => 'Teacher admin',
            'email' => 'teacher@admin.com',
            'password' => bcrypt('0011'),
            'phone_number' => '0798898678',
            'role' => 'teacher',
            'first_login' => false
        ]);

        Teacher::create([
            'user_id' => $user->id,
            'phone_number' => '0798898678',
        ]);


    }
}
