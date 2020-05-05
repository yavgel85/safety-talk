<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run(): void
    {
        // Admin (almighty)
        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));

        // Administrator
        $administrator_permissions = $admin_permissions->filter(static function ($permission) {
            return $permission->title !== 'sft_statistics' &&
                $permission->title !== 'sft_creation_theme' &&
                $permission->title !== 'sft_request' &&
                $permission->title !== 'sft_explanation' &&
                $permission->title !== 'sft_validation' &&
                $permission->title !== 'sft_db_management'
            ;
        });
        Role::findOrFail(2)->permissions()->sync($administrator_permissions);

        // Company manager
        $company_manager_permissions = $admin_permissions->filter(static function ($permission) {
            return strpos($permission->title, 'user_') !== 0 &&
                strpos($permission->title, 'role_') !== 0 &&
                strpos($permission->title, 'permission_') !== 0 &&
                strpos($permission->title, 'team_') !== 0 &&
                $permission->title !== 'sft_create_new_account'
            ;
        });
        Role::findOrFail(3)->permissions()->sync($company_manager_permissions);

        // Project manager
        $project_manager_permissions = $admin_permissions->filter(static function ($permission) {
            return strpos($permission->title, 'user_') !== 0 &&
                strpos($permission->title, 'role_') !== 0 &&
                strpos($permission->title, 'permission_') !== 0 &&
                strpos($permission->title, 'team_') !== 0 &&
                $permission->title !== 'sft_create_new_account'
            ;
        });
        Role::findOrFail(4)->permissions()->sync($project_manager_permissions);

        // Site manager
        $site_manager_permissions = $admin_permissions->filter(static function ($permission) {
            return $permission->title === 'sft_explanation' || $permission->title === 'sft_validation';
        });
        Role::findOrFail(5)->permissions()->sync($site_manager_permissions);
    }
}
