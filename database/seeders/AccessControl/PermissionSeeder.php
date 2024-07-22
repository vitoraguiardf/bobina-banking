<?php

namespace Database\Seeders\AccessControl;

use Database\Seeders\ItemSeeder;
use Illuminate\Contracts\Validation\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends ItemSeeder
{
    
    protected $items = [
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

    
    function persit(Validator $validator): void
    {
        $permission = Permission::create($validator->safe(['name', 'title', 'description', 'module']));
        
        $roles = $validator->safe(['roles']);
        foreach($roles as $role) {
            $this->command->warn('seeding role '. $role);
            $role = Role::findByName($role);
            $role->syncPermissions($permission->name);
            $role->save();
        }
    }

    function rules(): array
    {
        return [
            'name' => 'required|string|max:30',
            'title' => 'required|string|max:30',
            'module' => 'required|string|max:30',
            'description' => 'required|string|max:255',
        ];
    }

}
