<?php

namespace App\Repository;

use App\Models\Pets;
use App\Repository\Interfaces\IPetsRepository;
use ErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PetsRepository implements IPetsRepository
{
    public function getAll() : array
    {
        try
        {
            return (['pets' => Pets::all()]);
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

    public function getPets(int $id) : array
    {
        try
        {
            $pets = Pets::find($id);
            return $pets ? (['pet' => $pets]) : (['pet' => 'Pet não encontrado']) ;
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
            $pets = Pets::create($request)->save();
            return $pets ? (['response' => 'Pet cadastrado com sucesso']) : (['response' => 'Erro ao cadastrar o pet']);
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
            if(!$pets) return (['response' => 'Pet não encontrado']);
            $pets->delete();
            return (['response' => 'Pet deletado']);
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
            $pets = Pets::where('id', $request['id'])
            ->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => $request['password']
            ]);
            return (['response' => 'Animal atualizado com sucesso']);
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
}