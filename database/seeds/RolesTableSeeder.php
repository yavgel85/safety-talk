<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'id'    => 1,
                'title' => 'Admin',
            ],
            [
                'id'    => 2,
                'title' => 'Administrator',
            ],
            [
                'id'    => 3,
                'title' => 'Company manager',
            ],
            [
                'id'    => 4,
                'title' => 'Project manager',
            ],
            [
                'id'    => 5,
                'title' => 'Site manager',
            ],
        ];

        Role::insert($roles);

    }
}
