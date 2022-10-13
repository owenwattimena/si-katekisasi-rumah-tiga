<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = "Admin";
        $user->username = "admin";
        $user->password = Hash::make( "password" );
        $user->akses = "admin";
        $user->save();
    }
}
