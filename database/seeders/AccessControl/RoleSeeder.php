<?php

namespace Database\Seeders\AccessControl;

use Database\Seeders\ItemSeeder;
use Illuminate\Contracts\Validation\Validator;
use Spatie\Permission\Models\Role;

class RoleSeeder extends ItemSeeder
{
    
    protected $items = [
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
    
    function persit(Validator $validator): void
    {
        Role::create($validator->safe(['name', 'title', 'description']));
    }

    function rules(): array
    {
        return [
            'name' => 'required|string|max:30',
            'title' => 'required|string|max:30',
            'description' => 'required|string|max:255',
        ];
    }

}
