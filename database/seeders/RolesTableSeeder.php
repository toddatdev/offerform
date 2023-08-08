<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::firstOrNew([
            'name' => 'super-admin',
            'guard_name' => 'web',
        ]);
        if (!$role->exists) {
            $role->save();
        }

        $role = Role::firstOrNew([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);
        if (!$role->exists) {
            $role->save();
        }

        $role = Role::firstOrNew([
            'name' => 'agent',
            'guard_name' => 'web',
        ]);
        if (!$role->exists) {
            $role->save();
        }
    }
}
