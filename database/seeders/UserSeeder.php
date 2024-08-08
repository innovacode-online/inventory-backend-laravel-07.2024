<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
        DB::table("roles")->insert([
            "name" => "Admin",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);

        DB::table("roles")->insert([
            "name" => "Client",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);

        $roles = DB::table("roles")->get();

        DB::table("users")->insert([
            "name" => "Mattias Duarte",
            "email" => "mattias@correo.com",
            "role_id" => $roles[1]->id,
            "password" => Hash::make("Admin123"),
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);

        DB::table("users")->insert([
            "name" => "Innova Code",
            "email" => "innovacoed@correo.com",
            "role_id" => $roles[0]->id,
            "password" => Hash::make("Admin123"),
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);
    }
}
