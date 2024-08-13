<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;
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

        $routes = Route::getRoutes();
        foreach ($routes as $route) {
            if ($route->getName()!=null) {
                $permissions[] = [
                    'name' => $route->getName(),
                    'title' => $route->methods()[0] . ' >> ' . $route->getName(),
                    'guard_name' => 'web',
                    'description' => 'Permission for access to ' . $route->getName() . ' route.',
                    'module' => 'User',
                    'roles' => ['office.admin', 'office.super'],
                ];
            }
        }

        foreach ($permissions as $permission) {
            Permission::create(collect($permission)->only(['name', 'title', 'guard_name', 'description', 'module'])->toArray());
            $roles = $permission['roles'];
            foreach($roles as $role) {
                $role = Role::findByName($role);
                $role->givePermissionTo($permission['name']);
                $role->save();
            }
        }

    }
}
