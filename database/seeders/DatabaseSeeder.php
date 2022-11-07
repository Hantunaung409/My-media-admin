<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
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
       User::create([
        'name' => 'Admin Han',
        'email' => 'hanhtunaung777@gmail.com',
        'phone' => '1111111111',
        'gender' => 'male',
        'address' => 'MyitKyiNa',
        'password' => Hash::make('AdminHan12')
       ]);
    }
}