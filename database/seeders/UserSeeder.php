<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->insert([
            "name" => "Mattias Duarte",
            "email" => "mattias@correo.com",
            "password" => Hash::make("Admin123"),
        ]);

        DB::table("users")->insert([
            "name" => "Innova Code",
            "email" => "innovacoed@correo.com",
            "password" => Hash::make("Admin123"),
        ]);
    }
}
