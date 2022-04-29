<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin User
        $user = new User();
        $user->name = 'Administrator';
        $user->email = 'admin@admin.com';
        $user->password = Hash::make('123456789');
        $user->save();
    }
}
