<?php

namespace App\Services;

use App\Repository\Interfaces\IPetsRepository;
use App\Services\Interfaces\IFilesServices;
use App\Services\Interfaces\IPetsServices;

class PetsServices implements IPetsServices
{
    protected IPetsRepository $pets;
    protected IFilesServices $file;

    public function __construct(IPetsRepository $pets,IFilesServices $file) 
    {
        $this->pets = $pets;
        $this->file = $file;
    }

    public function store(array $request) : array
    {
        return $this->pets->store($request);
    }

    public function update(array $request) : array
    {
        return $this->pets->update($request);
    }

    public function delete(int $id) : array
    {
        return $this->pets->delete($id);
    }

    public function getPet(int $id) : array
    {
        return $this->pets->getPet($id);
    }

    public function getAll() : array
    {
        $petsDb = json_decode($this->pets->getAll());
        $pets = [];
        
        foreach($petsDb as $pet)
        {
            $pets[] = self::getImages((array)$pet);
        }
        return $pets;
    }

    private function getImages($pets)
    {
        $imagesName =([
            'img_header' => $pets['img_header'],
            'img1' => $pets['img1'],
            'img2' => $pets['img2'],
            'img3' => $pets['img3'],
            'img4' => $pets['img4']
        ]);
        $images = $this->file->get($imagesName);
        $pets['img_header'] = $images['img_header'];
        $pets['img1'] = $images['img1'];
        $pets['img2'] = $images['img2'];
        $pets['img3'] = $images['img3'];
        $pets['img4'] = $images['img4'];

        return $pets;
    }
}