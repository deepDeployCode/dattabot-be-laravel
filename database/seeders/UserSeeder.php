<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'dummy',
            'username' => 'userdummy',
            'email' => 'userdummy@gmail.com',
            'password' => Hash::make('12345678910'),
            'created_at' =>  \Carbon\Carbon::now(),
            'updated_at' =>  \Carbon\Carbon::now(),
        ]);
    }
}
