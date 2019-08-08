<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Administrator',
            'slug' => config('users.roles.admin'),
        ]);
        Role::create([
            'name' => 'Group Manager',
            'slug' => config('users.roles.group_manager'),
        ]);
        Role::create([
            'name' => 'Normal User',
            'slug' => config('users.roles.normal_user'),
        ]);
        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 1,
        ]);
        DB::table('role_user')->insert([
            'role_id' => 2,
            'user_id' => 2,
        ]);
        $users = User::where('id', '>', 2)->get();

        foreach ($users as $user) {
            $user->roles()->attach(3);
        }
    }
}
