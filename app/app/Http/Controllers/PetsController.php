<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\IFilesServices;
use App\Services\Interfaces\IPetsServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PetsController extends Controller
{
    protected IPetsServices $pets;
    protected IFilesServices $file;

    public function __construct(IPetsServices $pets, IFilesServices $file) 
    {
        $this->pets = $pets;
        $this->file = $file;
    }

    public function getAll() : JsonResponse
    {
        return response()->json($this->pets->getAll());
    }

    public function getPet(Request $request) : JsonResponse
    {
        $id = (int) $request->get('id');
        return response()->json($this->pets->getPet($id));
    }

    public function getNotifys(Request $request) : JsonResponse
    {
        return response()->json();
    }

    public function update(Request $request) : JsonResponse
    {
        return response()->json($this->pets->update([
            'pet' => $request->only(['id', 'name', 'weight', 'size', 'age', 'desc_pets', 'status', 'specie_id', 'breed_id']),
            'address' => $request->only(['city', 'state', 'country', 'cep', 'street', 'neighborhood', 'number']),
            'images' => ([
                'img_header' => $request->file('img_header'),
                'img1' => $request->file('img1'),
                'img2' => $request->file('img2'),
                'img3' => $request->file('img3'),
                'img4' => $request->file('img4')
            ])
        ]));
    }

    public function delete(Request $request) : JsonResponse
    {   
        $id = (int) $request->get('id');
        return response()->json($this->pets->delete($id));
    }

    public function store(Request $request) : JsonResponse
    {
        return response()->json($this->pets->store([
            'pet' => $request->only(['name', 'weight', 'size', 'age', 'desc_pets', 'status', 'specie_id', 'breed_id']),
            'address' => $request->only(['city', 'state', 'country', 'cep', 'street', 'neighborhood', 'number']),
            'images' => $this->file->store([
                'img_header' => $request->file('img_header'),
                'img1' => $request->file('img1'),
                'img2' => $request->file('img2'),
                'img3' => $request->file('img3'),
                'img4' => $request->file('img4')
            ])
        ]));
    }
}
