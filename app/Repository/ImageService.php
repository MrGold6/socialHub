<?php

namespace App\Repository;
use \App\Models\Image;

class ImageService
{
    public static function saveImageToFolder($imageFromForm, $path, $idPost = null, $name = null) {
        if(!$name)
            $name = self::getImageName($imageFromForm);
        if($idPost)
            self::setRecordInDB($idPost, $name);

        $imageFromForm->move(public_path($path), $idPost.'.jpg');
    }
    private static function setRecordInDB($idPost, $name) {
        $image = new Image();
        $image->idPost = $idPost;
        $image->imageName = $idPost.'.jpg';
        $image->save();
    }
    private static function getImageName($image) {
        return $image->getClientOriginalName();
    }

}
