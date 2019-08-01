<?php

namespace  App\Repositories\Group;

use App\Models\Group;
use App\Repositories\BaseRepository;

class GroupRepository extends BaseRepository implements GroupInterface
{
    public function getModel()
    {
        return Group::class;
    }
}
