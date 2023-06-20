<?php

namespace Database\Seeders;

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
        User::create(['first_name' => 'admin', 'last_name' => 'user', 'password' => 1234567896, 'email' => 'admin@admin.com']);
    }
}