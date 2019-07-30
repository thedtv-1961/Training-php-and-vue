<?php

use Illuminate\Database\Seeder;
use App\Models\Announcement;

class AnnouncementsTableSeeder extends Seeder
{
    public function run()
    {
        factory(Announcement::class, 10)->create();
    }
}
