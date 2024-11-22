<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(['name' => 'Mitso', 'email' => 'miroslav.blascanin@gmail.ch', 'password' => bcrypt('password'), 'is_admin' => 0]);
    }
}
