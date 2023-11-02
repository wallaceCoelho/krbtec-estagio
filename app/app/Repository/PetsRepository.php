<?php

namespace App\Repository;

use App\Models\Pets;
use App\Repository\Interfaces\IPetsRepository;
use App\Services\Interfaces\IFilesServices;
use ErrorException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class PetsRepository implements IPetsRepository
{
    protected IFilesServices $file;

    public function __construct(IFilesServices $file) {
        $this->file = $file;
    }
    public function getAll() 
    {
        try
        {
            $pets = Pets::join('address_pets', 'pets.id', '=', 'address_pets.pets_id')
            ->join('gallery_pets', 'pets.id', '=', 'gallery_pets.pets_id')
            ->select('pets.*', 'address_pets.*', 'gallery_pets.*')->get();
            return json_encode($pets);
        }
        catch(ModelNotFoundException $e)
        {
            return (['response' => '[ERRO] : ' . $e]);
        }
        catch(ErrorException $e)
        {
            return (['response' => '[ERRO] : ' . $e]);
        }
    }

    public function getPet(int $id) : array
    {
        try
        {
            if(!$pets = Pets::find($id)) return (['pet' => 'Registro não encontrado']);
            $pets->address;
            $pets->gallery;
            return (['pet' => $pets]);
        }
        catch(ErrorException $e)
        {
            return (['response' => '[ERRO] : ' . $e]);
        }
    }

    public function store(array $request) : array
    {
        try
        {
            $pets = Pets::create($request['pet']);
            $pets->address()->create($request['address']);
            $pets->gallery()->create($request['images']);
            $pets->save();
            return $pets ? (['response' => 'Registro cadastrado com sucesso']) 
                    : (['response' => 'Erro ao realizar o cadastro']);
        }
        catch(ErrorException $e)
        {
            return (['response' => '[ERRO] : ' . $e]);
        }
    }

    public function delete(int $id) 
    {
        try
        {
            $pets = Pets::find($id);
            if(!$pets) return (['response' => 'Registro não encontrado']);
            $pets->address()->delete();
            Storage::delete($pets->gallery);
            $pets->gallery()->delete();
            $pets->delete();
            return (['response' => 'Registro deletado']);
        }
        catch(ErrorException $e)
        {
            return (['response' => '[ERRO] : ' . $e]);
        }
    }

    public function update(array $request) : array
    {
        try
        {
            $pet = $request['pet'];
            $pets = Pets::find($pet['id']);
            if(!isset($pets)) return (['response' => 'Registro não encontrado']);
            
            return self::updateModels($pets, $request) ? (['response' => 'Cadastro atualizado com sucesso'])
                    : (['response' => 'Erro ao atualizar o cadastro']);
        }
        catch(ErrorException $e)
        {
            return (['response' => '[ERRO] : ' . $e]);
        }
        catch(ModelNotFoundException $e)
        {
            return (['response' => '[ERRO] : ' . $e]);
        }
    }

    private static function updateModels($pets, $request) : bool
    {
        try
        {
            $petsAddress = $pets->address;
            $petsGallery = $pets->gallery;
            $images = $request['images'];
            $address = $request['address'];
            $pet = $request['pet'];

            $pets->adress()->update([
                'city' => isset($address['city']) ? $address['city'] : $petsAddress['city'],
                'state' => isset($address['state']) ? $address['state'] : $petsAddress['state'],
                'country' => isset($address['country']) ? $address['country'] : $petsAddress['country'],
                'cep' => isset($address['cep']) ? $address['cep'] : $petsAddress['cep'],
                'street' => isset($address['street']) ? $address['street'] : $petsAddress['street'],
                'neighborhood' => isset($address['neighborhood']) ? $address['neighborhood'] : $petsAddress['neighborhood'],
                'number' => isset($address['number']) ? $address['number'] : $petsAddress['number']
            ]);

            $pets->gallery()->update([
                'img_header' => isset($images['img_header']) ? self::updateImages($images) : $petsGallery['img_header'],
                'img1' => isset($images['img1']) ? self::updateImages($images) : $petsGallery['img1'],
                'img2' => isset($images['img2']) ? self::updateImages($images) : $petsGallery['img2'],
                'img3' => isset($images['img3']) ? self::updateImages($images) : $petsGallery['img3'],
                'img4' => isset($images['img4']) ? self::updateImages($images) : $petsGallery['img4']
            ]);

            $pets->update([
                'name' => isset($pet['name']) ? $pet['name'] : $pets['name'],
                'weight' => isset($pet['weight']) ? $pet['weight'] : $pets['weight'],
                'size' => isset($pet['size']) ? $pet['size'] : $pets['size'],
                'age' => isset($pet['age']) ? $pet['age'] : $pets['age'],
                'desc_pets' => isset($pet['desc_pets']) ? $pet['desc_pets'] : $pets['desc_pets'],
                'status' => isset($pet['status']) ? $pet['status'] : $pets['status'],
                'specie_id' => isset($pet['specie_id']) ? $pet['specie_id'] : $pets['specie_id'],
                'breed_id'  => isset($pet['breed_id']) ? $pet['breed_id'] : $pets['breed_id']
            ]);
            return true;
        }
        catch(Exception)
        {
            return false;
        }
    }

    private function updateImages(array $images)
    {
        Storage::delete($images);
        return $this->file->store((array)$images);
    }
}