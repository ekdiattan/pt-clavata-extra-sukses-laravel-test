<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\User\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
    */

    public function run(): void
    {
        User::create([
            'nama' => 'User',
            'email' => 'user1@example.com',
            'password' => bcrypt('password')
        ]);
        
        User::create([
            'nama' => 'User',
            'email' => 'user2@example.com',
            'password' => bcrypt('password')
        ]);
    }
}
