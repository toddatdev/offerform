<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addOrUpdatePermission(Str::slug('View Only'));
        $this->addOrUpdatePermission(Str::slug('Create Team Accounts'));
        $this->addOrUpdatePermission(Str::slug('Edit Team Accounts'));
        $this->addOrUpdatePermission(Str::slug('Create Category'));
        $this->addOrUpdatePermission(Str::slug('Edit Category'));
        $this->addOrUpdatePermission(Str::slug('Create New Admin'));
        $this->addOrUpdatePermission(Str::slug('Edit Admin Account'));
        $this->addOrUpdatePermission(Str::slug('Change Pricing Plans'));
        $this->addOrUpdatePermission(Str::slug('Edit Agent Account'));
        $this->addOrUpdatePermission(Str::slug('View Analytics'));
        $this->addOrUpdatePermission(Str::slug('CMS Manager'));
        $this->addOrUpdatePermission(Str::slug('Form Library'));
        $this->addOrUpdatePermission(Str::slug('Step Library'));
    }

    public function addOrUpdatePermission($find, $update = null)
    {
        $permission = Permission::firstOrNew([
            'name' => $find
        ]);
        if (!$permission->exists) {
            $permission->fill([
                'name' => $update ?? $find,
                'guard_name' => 'web',
            ])->save();
        }
    }
}
