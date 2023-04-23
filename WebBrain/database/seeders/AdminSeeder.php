<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'first_name' => 'Ankit',
            'last_name' => 'jain',
            'address' => '123 Main Street',
            'mobile' => 8690789809,
            'email' => 'admin@gmail.com',
            'password' => bcrypt(12345678),
            'role' => 'admin',
            'status' => 'Active'
        ]);
    }
}