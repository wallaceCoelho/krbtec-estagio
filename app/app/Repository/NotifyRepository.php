<?php

namespace App\Repository;

use App\Models\Notify_pets;
use App\Models\Pets;
use App\Repository\Interfaces\INotifyRepository;
use App\Repository\Interfaces\IPetsRepository;
use App\Services\Interfaces\IFilesServices;
use DateTime;
use ErrorException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;

class NotifyRepository implements INotifyRepository
{
    public function getAll()
    {
        return Notify_pets::all();
    }

    public function getNotify(int $id) : array
    {
        try
        {
            $notify = Notify_pets::find($id);
            return $notify ? ($notify) : ['response' => 'Notificação não encontrada'];
        }
        catch(ErrorException $e)
        {
            return (['response' => '[ERRO] : ' . $e]);
        }
        
    }

    public function store(array $request) : bool
    {
        try
        {
            $pet = Pets::find($request['id']);
            $pet->notify()->create([
                'name' => $request['name'],
                'email' => $request['email'],
                'cpf' => $request['cpf'],
                'phone' => strval($request['phone']),
                'dt_birth' => new DateTime($request['dt_birth'])
            ]);
            return true;
        }
        catch(ErrorException $e)
        {
            return false;
        }
    }

    public function delete(int $id)
    {
        try
        {
            $notify = Notify_pets::find($id);
            $notify->delete();
            return (['response' => 'Notificação deletada']);
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
            $notify = Notify_pets::find((int) $request['id']);
            if(!$notify) return (['response' => 'Notificação não encontrado']);
            $notify->update([
                'name' => isset($request['name']) ? $request['name'] : $notify['name'],
                'email' => isset($request['email']) ? $request['email'] : $notify['email'],
                'phone' => isset($request['phone']) ? $request['phone'] : $notify['status'],
                'dt_birth' => isset($request['dt_birth']) ? $request['dt_birth'] : $notify['password']
            ]);
            return (['response' => 'Notificação atualizada com sucesso']);
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