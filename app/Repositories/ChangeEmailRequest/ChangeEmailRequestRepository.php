<?php

namespace  App\Repositories\ChangeEmailRequest;

use App\Models\ChangeEmailRequest;
use App\Repositories\BaseRepository;

class ChangeEmailRequestRepository extends BaseRepository implements ChangeEmailRequestInterface
{
    public function getModel()
    {
        return ChangeEmailRequest::class;
    }
}
