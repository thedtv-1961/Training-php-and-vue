<?php

namespace App\Traits;

trait FileProcesser
{
    /**
     * Upload image file
     *
     * @param $file
     * @param $pathUpload
     * @return string
     */
    public function uploadImage($file, $pathUpload)
    {
        $randomName = uniqid() . time() . '.' . $file->getClientOriginalExtension();
        $filePath = $file->move($pathUpload, $randomName);

        return basename($filePath);
    }

    /**
     * Delete image file
     *
     * @param $filePath
     */
    public function deleteImage($filePath)
    {
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
}
