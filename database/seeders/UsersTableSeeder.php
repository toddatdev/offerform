<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::all();

        foreach ($roles as $role) {
            $user = User::firstOrNew([
                'first_name' => $role->name,
                'last_name' => $role->name,
                'email' => "$role->name@app.com",
            ]);
            if (!$user->exists) {
                $user->fill([
                    'password' => \Hash::make('password'),
                    'email_verified_at' => Carbon::now(),
                ])->save();

                $user->assignRole($role);
            }
        }
    }
}
