<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    public function setImageAttribute($image)
    {
        if (isset($this->attributes['image']) && $this->attributes['image'] != $image) {
            $file = public_path() . DIRECTORY_SEPARATOR . $this->attributes['image'];
            if (file_exists($file)) {
                @unlink($file);
            }
        }
        $this->attributes['image'] = $image;

        $file = public_path() . DIRECTORY_SEPARATOR . $image;

        $img = \Image::make($file);
        $img->resize(1920, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $img->save($file, 100);
    }

    public function setImageXsAttribute($image)
    {
        if (isset($this->attributes['image_xs']) && $this->attributes['image_xs'] != $image) {
            $file = public_path() . DIRECTORY_SEPARATOR . $this->attributes['image_xs'];
            if (file_exists($file)) {
                @unlink($file);
            }
        }
        $this->attributes['image_xs'] = $image;

        $file = public_path() . DIRECTORY_SEPARATOR . $image;

        $img = \Image::make($file);
        $img->resize(375, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $img->save($file, 100);
    }
}
