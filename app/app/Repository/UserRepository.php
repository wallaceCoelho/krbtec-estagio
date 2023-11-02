<?php

namespace App\Repository;

use App\Models\User;
use App\Repository\Interfaces\IUserRepository;
use ErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository implements IUserRepository
{
    public function getAll() : array
    {
        try
        {
            return (['users' => User::all()]);
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

    public function getUser(int $id) : array
    {
        try
        {
            $user = User::find($id);
            return $user ? (['user' => $user]) : (['user' => 'Usuário não encontrado']) ;
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
            $user = User::create($request)->save();
            return $user ? (['response' => 'Usuário cadastrado com sucesso']) : (['response' => 'Erro ao cadastrar novo usuário']);
        }
        catch(ErrorException $e)
        {
            return (['response' => '[ERRO] : ' . $e]);
        }
    }

    public function delete(int $id) : array
    {
        try
        {
            $user = User::find($id);
            if(!$user) return (['response' => 'Usuário não encontrado']);
            $user->truncate();
            return (['response' => 'Usuário deletado']);
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
            $user = User::find((int) $request['id']);
            if(!$user) return (['response' => 'Usuário não encontrado']);
            $user->update([
                'name' => isset($request['name']) ? $request['name'] : $user['name'],
                'email' => isset($request['email']) ? $request['email'] : $user['email'],
                'status' => isset($request['status']) ? $request['status'] : $user['status'],
                'password' => isset($request['password']) ? $request['password'] : $user['password']
            ]);
            return (['response' => 'Usuário atualizado com sucesso']);
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