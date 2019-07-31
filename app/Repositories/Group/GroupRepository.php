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

    public function likeSearch($column, $key)
    {
        $this->model = $this->model->likeSearch($column, $key);

        return $this;
    }
}
