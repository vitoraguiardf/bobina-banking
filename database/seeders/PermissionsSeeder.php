<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed roles
        $roles = [
            [
                'name' => 'office.admin',
                'title' => 'Administrador',
                'guard_name' => 'web',
                'description' => 'This role will assign to Administrator',
            ],
            [
                'name' => 'office.super',
                'title' => 'Supervisor',
                'guard_name' => 'web',
                'description' => 'This role will assign to Supervisor',
            ],
            [
                'name' => 'office.monit',
                'title' => 'Monitor',
                'guard_name' => 'web',
                'description' => 'This role will assign to Monitor.',
            ],
            [
                'name' => 'office.agent',
                'title' => 'Agente',
                'guard_name' => 'web',
                'description' => 'This role will assign to Agente.',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }

        // Seed Permissions
        $permissions = [
            [
                'name' => 'acl.manager',
                'title' => 'Admin Panel',
                'guard_name' => 'web',
                'description' => 'This permission is for access to admin panel.',
                'module' => 'User',
                'roles' => ['office.admin'],
            ],
            [
                'name' => 'dashboard.panel',
                'title' => 'Dashboard Panel',
                'guard_name' => 'web',
                'description' => 'This permission is for access to dashboard panel.',
                'module' => 'User',
                'roles' => ['office.admin'],
            ],
    
            // Users permissions
            [
                'name' => 'acl.users.index',
                'title' => 'Display users',
                'guard_name' => 'web',
                'description' => 'The admin panel\'s user list can be viewed with this permission.',
                'module' => 'User',
                'roles' => ['office.admin'],
            ],
            [
                'name' => 'acl.users.create',
                'title' => 'Create user',
                'guard_name' => 'web',
                'description' => 'The user is able to add new users with this ability.',
                'module' => 'User',
                'roles' => ['office.admin'],
            ],
            [
                'name' => 'acl.users.edit',
                'title' => 'Edit user',
                'guard_name' => 'web',
                'description' => 'The user is able to edit users with this ability.',
                'module' => 'User',
                'roles' => ['office.admin'],
            ],
            [
                'name' => 'acl.users.delete',
                'title' => 'Delete user',
                'guard_name' => 'web',
                'description' => 'The user is able to delete users with this ability.',
                'module' => 'User',
                'roles' => ['office.admin'],
            ],
            // Roles Permission
            [
                'name' => 'acl.roles.index',
                'title' => 'Display roles',
                'guard_name' => 'web',
                'description' => 'The admin panel\'s roles list can be viewed with this permission.',
                'module' => 'User',
                'roles' => ['office.admin'],
            ],
            [
                'name' => 'acl.roles.create',
                'title' => 'Create roles',
                'guard_name' => 'web',
                'description' => 'The user is able to add new roles with this ability.',
                'module' => 'User',
                'roles' => ['office.admin'],
            ],
            [
                'name' => 'acl.roles.edit',
                'title' => 'Edit roles',
                'guard_name' => 'web',
                'description' => 'The user is able to edit roles with this ability.',
                'module' => 'User',
                'roles' => ['office.admin'],
            ],
            [
                'name' => 'acl.roles.delete',
                'title' => 'Delete roles',
                'guard_name' => 'web',
                'description' => 'The user is able to delete roles with this ability.',
                'module' => 'User',
                'roles' => ['office.admin'],
            ],
            // Permissions' permissions
            [
                'name' => 'acl.permissions.index',
                'title' => 'Display permissions',
                'guard_name' => 'web',
                'description' => 'The admin panel\'s permissions list can be viewed with this permission.',
                'module' => 'User',
                'roles' => ['office.admin'],
            ],
            [
                'name' => 'acl.permissions.create',
                'title' => 'Create permissions',
                'guard_name' => 'web',
                'description' => 'The user is able to add new permissions with this ability.',
                'module' => 'User',
                'roles' => ['office.admin'],
            ],
            [
                'name' => 'acl.permissions.edit',
                'title' => 'Edit permissions',
                'guard_name' => 'web',
                'description' => 'The user is able to edit permissions with this ability.',
                'module' => 'User',
                'roles' => ['office.admin'],
            ],
            [
                'name' => 'acl.permissions.delete',
                'title' => 'Delete permissions',
                'guard_name' => 'web',
                'description' => 'The user is able to delete permissions with this ability.',
                'module' => 'User',
                'roles' => ['office.admin'],
            ],
            // Group permissions
            [
                'name' => 'acl.groups.index',
                'title' => 'Display groups',
                'guard_name' => 'web',
                'description' => 'The admin panel\'s groups list can be viewed with this permission.',
                'module' => 'User',
                'roles' => ['office.admin'],
            ],
            [
                'name' => 'acl.groups.create',
                'title' => 'Create groups',
                'guard_name' => 'web',
                'description' => 'The user is able to add new groups with this ability.',
                'module' => 'User',
                'roles' => ['office.admin'],
            ],
            [
                'name' => 'acl.groups.edit',
                'title' => 'Edit groups',
                'guard_name' => 'web',
                'description' => 'The user is able to edit groups with this ability.',
                'module' => 'User',
                'roles' => ['office.admin'],
            ],
            [
                'name' => 'acl.groups.delete',
                'title' => 'Delete groups',
                'guard_name' => 'web',
                'description' => 'The user is able to delete groups with this ability.',
                'module' => 'User',
                'roles' => ['office.admin'],
            ],
        ];
        foreach ($permissions as $permission) {
            $collection = collect($permission);
            Permission::create($collection->only(['name', 'title', 'guard_name', 'description', 'module'])->toArray());
            $roles = $collection->only(['roles']);
            foreach($roles as $role) {
                $role = Role::findByName($role[0]);
                $role->givePermissionTo($permission['name']);
                $role->save();
            }
        }

    }
}
