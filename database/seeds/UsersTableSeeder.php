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
                'password'       => '$2y$10$ralWsuilw84Wx6W52IAnceqDCVovjpsBJ1Fmv19jnfIeKRpNuFHFa',
                'remember_token' => null,
                'approved'       => 1,
            ],
        ];

        User::insert($users);

    }
}
