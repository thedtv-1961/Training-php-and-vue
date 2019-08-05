<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        factory(User::class)->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
        ]);
        factory(User::class)->create([
            'name' => 'group manager',
            'email' => 'manager@gmail.com',
        ]);
        factory(User::class)->create([
            'name' => 'user',
            'email' => 'user@gmail.com',
        ]);
        factory(User::class, 10)->create();
    }
}
