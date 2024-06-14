<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            "username" => env("MAIL_FROM_NAME"),
            "email" => env("MAIL_FROM_ADDRESS"),
            "password" => Hash::make(env("PASSWORD"))
        ]);

        Role::insert([
            'title' => 'ADMIN',
            'title' => 'USER',
        ]);

        Role::find(1)->user()->attach(User::find(1));
        
        if(app()->environment() != "production") {
            User::factory()->count(3)->create();
        }
   
    }
} 
