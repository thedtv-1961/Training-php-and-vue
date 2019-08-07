<?php

namespace App\Repositories\User;

interface UserInterface
{
    /**
     * Upload user avatar
     * @param  $request
     * @param  string  $name
     * @param  string  $oldAvatarName
     * @param  string  $pathUpload
     * 
     * @return mixed
     */
    public function uploadAvatar($request, $name, $oldAvatarName, $pathUpload);

    /**
     * @param  object  $keyword
     * @param  string  $column_name
     * @return BuilderObject
     */
    public function likeSearch($keyword, $column_name);
}
