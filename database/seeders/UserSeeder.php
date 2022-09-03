<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    public function run() {
        User::create(["name"=>"Admin",
            "level"=>User::ADMIN_LEVEL, 
            "email"=>"admin@gmail.com", 
            "password"=>Hash::make("12345678")]);
    }
}
