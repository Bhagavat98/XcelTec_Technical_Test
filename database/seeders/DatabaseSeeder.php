<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            'firstname' => 'XcelTec',
            'lastname' => 'Technologies',
            'email'=>'admin@mailiator.com',
            'password' => Hash::make('Admin@123'),
            'phone_number' => '1234567890',
            'user_role_id'=>'0', // admin type 0
            'is_active'=>'1', // 1 is active
            'dob'=>'1995-06-15',
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
