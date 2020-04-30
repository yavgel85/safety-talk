<?php

use App\User;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    public function run(): void
    {
        User::findOrFail(1)->roles()->sync(1);
    }
}
