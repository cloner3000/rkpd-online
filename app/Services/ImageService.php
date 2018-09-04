<?php

namespace App\Services;

use Intervention\Image\Facades\Image;

class ImageService
{
    public function imageUpload($file, $item, $field, $folder = 'uploads')
    {
        $path = substr(md5(date('Y-m-d-H')), 0, 20);
        $public_path = '/'.$folder;
        $storage_path = '/app/public/'.$folder;
        $storage_path_abs = storage_path($storage_path);

        if (!is_dir($storage_path_abs)) {
            mkdir($storage_path_abs, 0755, true);
        }

        $RandomAccountNumber = uniqid();
        $photo_filename = $path . $RandomAccountNumber . '.jpg';
        $item->$field = $public_path . '/' . $path . $photo_filename;
        $image = Image::make($file);
        $image->save($storage_path_abs . '/' . $path . $photo_filename);

        return $item;
    }
}