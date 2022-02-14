<?php

namespace App;

use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class ImageHelper
{

    public static function moveImage($file, $folder)
    {

        $image_name = strtolower(time().'_'.$file->getClientOriginalName());
        $image_name = Str::slug($image_name).'.'.strtolower($file->getClientOriginalExtension());

        $file->move(storage_path($folder), $image_name);

        return $folder.$image_name;
    }

    public static function getImage($path)
    {
        if(File::exists(storage_path($path))) {
            return response()->file(
                storage_path($path)
            );
        } else {
            return response()->file(
                public_path('app/default/profile.jpg')
            );
        }
    }

}

