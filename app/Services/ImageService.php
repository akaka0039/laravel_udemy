<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use InterventionImage;

class ImageService
{
    public static function upload($imageFile, $folderName)
    {

        //dd($imageFile['image']);
        // 20220128_add_配列で入ってくるため
        if (is_array($imageFile)) {
            $file = $imageFile['image'];
        } else {
            $file = $imageFile;
        }

        //ランダムなファイル名を作成
        $fileName = uniqid(rand() . '_');
        // 拡張子取得
        $extension = $file->extension();
        $fileNameToStore = $fileName . '.' . $extension;
        $resizedImage = InterventionImage::make($file)->resize(1920, 1080)->encode();
        Storage::put(
            'public/' . $folderName . '/' . $fileNameToStore,
            $resizedImage
        );

        return $fileNameToStore;
    }
}
