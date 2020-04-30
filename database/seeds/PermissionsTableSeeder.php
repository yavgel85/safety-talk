<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'team_create',
            ],
            [
                'id'    => '18',
                'title' => 'team_edit',
            ],
            [
                'id'    => '19',
                'title' => 'team_show',
            ],
            [
                'id'    => '20',
                'title' => 'team_delete',
            ],
            [
                'id'    => '21',
                'title' => 'team_access',
            ],
            [
                'id'    => '22',
                'title' => 'company_create',
            ],
            [
                'id'    => '23',
                'title' => 'company_edit',
            ],
            [
                'id'    => '24',
                'title' => 'company_show',
            ],
            [
                'id'    => '25',
                'title' => 'company_delete',
            ],
            [
                'id'    => '26',
                'title' => 'company_access',
            ],
            [
                'id'    => '27',
                'title' => 'instruction_create',
            ],
            [
                'id'    => '28',
                'title' => 'instruction_edit',
            ],
            [
                'id'    => '29',
                'title' => 'instruction_show',
            ],
            [
                'id'    => '30',
                'title' => 'instruction_delete',
            ],
            [
                'id'    => '31',
                'title' => 'instruction_access',
            ],
            [
                'id'    => '32',
                'title' => 'category_create',
            ],
            [
                'id'    => '33',
                'title' => 'category_edit',
            ],
            [
                'id'    => '34',
                'title' => 'category_show',
            ],
            [
                'id'    => '35',
                'title' => 'category_delete',
            ],
            [
                'id'    => '36',
                'title' => 'category_access',
            ],
            [
                'id'    => '37',
                'title' => 'worker_create',
            ],
            [
                'id'    => '38',
                'title' => 'worker_edit',
            ],
            [
                'id'    => '39',
                'title' => 'worker_show',
            ],
            [
                'id'    => '40',
                'title' => 'worker_delete',
            ],
            [
                'id'    => '41',
                'title' => 'worker_access',
            ],
            [
                'id'    => '42',
                'title' => 'workers_list_create',
            ],
            [
                'id'    => '43',
                'title' => 'workers_list_edit',
            ],
            [
                'id'    => '44',
                'title' => 'workers_list_show',
            ],
            [
                'id'    => '45',
                'title' => 'workers_list_delete',
            ],
            [
                'id'    => '46',
                'title' => 'workers_list_access',
            ],
            [
                'id'    => '47',
                'title' => 'status_create',
            ],
            [
                'id'    => '48',
                'title' => 'status_edit',
            ],
            [
                'id'    => '49',
                'title' => 'status_show',
            ],
            [
                'id'    => '50',
                'title' => 'status_delete',
            ],
            [
                'id'    => '51',
                'title' => 'status_access',
            ],
            [
                'id'    => '52',
                'title' => 'sent_instruction_create',
            ],
            [
                'id'    => '53',
                'title' => 'sent_instruction_edit',
            ],
            [
                'id'    => '54',
                'title' => 'sent_instruction_show',
            ],
            [
                'id'    => '55',
                'title' => 'sent_instruction_delete',
            ],
            [
                'id'    => '56',
                'title' => 'sent_instruction_access',
            ],
            [
                'id'    => '57',
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
