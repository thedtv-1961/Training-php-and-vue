<?php

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Group::class, 10)->create();

        for ($i = 1; $i <= 10; $i++) {
            DB::table('group_user')->insert([
                'user_id' => rand(1, 10),
                'group_id' => rand(1, 10),
            ]);
        }
    }
}
