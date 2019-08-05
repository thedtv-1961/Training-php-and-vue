<?php

namespace App\Repositories\User;

use Storage;
use App\Models\User;
use App\Traits\FileProcesser;
use App\Repositories\BaseRepository;

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
        $pathFile = $oldAvatarName;

        if (Storage::disk('local')->exists($oldAvatarName) && $oldAvatarName != config('settings.avatar_default_path')) {
            Storage::disk('local')->delete($oldAvatarName);
        }

        return $this->uploadUserAvatar($request, $name, $pathUpload);
    }
}
