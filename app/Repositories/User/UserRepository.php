<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Traits\FileProcesser;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Storage;

class UserRepository extends BaseRepository implements UserInterface
{
    use FileProcesser;

    /**
     * {@inheritDoc}
     */
    public function getModel()
    {
        return User::class;
    }

    /**
     * {@inheritDoc}
     */
    public function uploadAvatar($request, $name, $oldAvatarName, $pathUpload)
    {
        if (Storage::disk('local')->exists($oldAvatarName)
            && $oldAvatarName != config('settings.avatar_default_path')) {
            Storage::disk('local')->delete($oldAvatarName);
        }

        return $this->uploadUserAvatar($request, $name, $pathUpload);
    }

    /**
     * {@inheritDoc}
     */
    public function likeSearch($keyword, $columnName)
    {
        if (!empty($keyword)) {
            $this->model = $this->model->where($columnName, 'LIKE', '%' . $keyword . '%');
        }

        return $this;
    }
}
