<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$HTcnvLHZRlUvh5ixSu1EyONU5O/FFRhI13F3AYJP0VSE2gRa4EYyi',
                'remember_token' => null,
            ],
        ];

        User::insert($users);

    }
}
