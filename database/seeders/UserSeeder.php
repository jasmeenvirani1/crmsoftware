<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $users = [
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@koolmind.com',
                'password' => Hash::make('KMTEST@123'),
                'remember_token' => null,
                'created_at' => '2019-09-13 19:21:30',
                'updated_at' => '2019-09-13 19:21:30',
                'mobile_number' => '123456789',
                'referral_code' => 'admin111',
                'user_type' => 'Admin',
                'is_active' => '1',
            ],
            [
                'id' => 2,
                'name' => 'Merchant',
                'email' => 'merchant@gmail.com',
                'password' => Hash::make('merchant@123'),
                'remember_token' => null,
                'created_at' => '2019-09-13 19:21:30',
                'updated_at' => '2019-09-13 19:21:30',
                'mobile_number' => '123456789',
                'referral_code' => 'merchant111',
                'user_type' => 'Merchant',
                'is_active' => '1',
            ],
            [
                'id' => 3,
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('user@123'),
                'remember_token' => null,
                'created_at' => '2019-09-13 19:21:30',
                'updated_at' => '2019-09-13 19:21:30',
                'mobile_number' => '123456789',
                'referral_code' => 'user111',
                'user_type' => 'User',
                'is_active' => '1',
            ],
        ];
        User::insert($users);
    }

}
