<?php

namespace App\Services;

use App\Services\Interfaces\IFilesServices;
use Illuminate\Support\Facades\Storage;
use Psy\Readline\Hoa\FileException;

class FilesServices implements IFilesServices
{
    public function store(array $images) : array
    {
        $imgName = self::getImgName($images);
        return self::storeDirectory($imgName, $images);
    }

    public function get($imgName) : array
    {
        $data = ([
            'img_header' => Storage::files($imgName['img_header'])[0],
            'img1' => Storage::files($imgName['img1'])[0],
            'img2' => Storage::files($imgName['img2'])[0],
            'img3' => Storage::files($imgName['img3'])[0],
            'img4' => Storage::files($imgName['img4'])[0]
        ]);
        
        return $data;
    }

    private static function getImgName($images) : array
    {
        return ([
            'img_header' => (string)uniqid()."_".$images['img_header']->getClientOriginalName(),
            'img1' => (string)uniqid()."_".$images['img1']->getClientOriginalName(),
            'img2' => (string)uniqid()."_".$images['img2']->getClientOriginalName(),
            'img3' => (string)uniqid()."_".$images['img3']->getClientOriginalName(),
            'img4' => (string)uniqid()."_".$images['img4']->getClientOriginalName()
        ]);
    }

    private static function storeDirectory($imgName, $images) : array
    {
        try
        {
            Storage::disk('local')->put($imgName['img_header'], $images['img_header']);
            Storage::disk('local')->put($imgName['img1'], $images['img1']);
            Storage::disk('local')->put($imgName['img2'], $images['img2']);
            Storage::disk('local')->put($imgName['img3'], $images['img3']);
            Storage::disk('local')->put($imgName['img4'], $images['img4']);
            return $imgName;
        }
        catch(FileException)
        {
            return [];
        }
    }
}