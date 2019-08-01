<?php

namespace  App\Repositories\Announcement;

use App\Models\Announcement;
use App\Repositories\BaseRepository;

class AnnouncementRepository extends BaseRepository implements AnnouncementInterface
{
    public function getModel()
    {
        return Announcement::class;
    }
}
