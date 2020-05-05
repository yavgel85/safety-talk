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
                'password'       => '$2y$10$ySPSqcJROzfSyVgLuqjqHOzNPTD3HrgeQp2nLExQNEeA9U0J4G1ga',
                'remember_token' => null,
                'approved'       => 1,
                'phone'          => '',
            ],
            [
                'id'             => 2,
                'name'           => 'Administrator',
                'email'          => 'administrator@administrator.com',
                'password'       => '$2y$10$ySPSqcJROzfSyVgLuqjqHOzNPTD3HrgeQp2nLExQNEeA9U0J4G1ga',
                'remember_token' => null,
                'approved'       => 1,
                'phone'          => '',
            ],
            [
                'id'             => 3,
                'name'           => 'Company manager',
                'email'          => 'company_manager@manager.com',
                'password'       => '$2y$10$ySPSqcJROzfSyVgLuqjqHOzNPTD3HrgeQp2nLExQNEeA9U0J4G1ga',
                'remember_token' => null,
                'approved'       => 1,
                'phone'          => '',
            ],
            [
                'id'             => 4,
                'name'           => 'Project manager',
                'email'          => 'project_manager@manager.com',
                'password'       => '$2y$10$ySPSqcJROzfSyVgLuqjqHOzNPTD3HrgeQp2nLExQNEeA9U0J4G1ga',
                'remember_token' => null,
                'approved'       => 1,
                'phone'          => '',
            ],
            [
                'id'             => 5,
                'name'           => 'Site manager',
                'email'          => 'site_manager@manager.com',
                'password'       => '$2y$10$ySPSqcJROzfSyVgLuqjqHOzNPTD3HrgeQp2nLExQNEeA9U0J4G1ga',
                'remember_token' => null,
                'approved'       => 1,
                'phone'          => '',
            ],
        ];

        User::insert($users);

    }
}
