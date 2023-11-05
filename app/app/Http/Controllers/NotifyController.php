<?php

namespace App\Http\Controllers;

use App\Mail\MailService;
use App\Models\Pets;
use App\Repository\Interfaces\INotifyRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NotifyController extends Controller
{
    protected INotifyRepository $notify;

    public function __construct(INotifyRepository $notify) {
        $this->notify = $notify;
    }

    public function send(array $request) : bool
    {
        $to = $request['email'];    
        $pet = Pets::find($request['id']);
        if($pet)
        {
            $request['pet'] = $pet;
            Mail::to($to)->send(new MailService($request));
            return true;
        }
        return false;
    }

    public function store(Request $request) : JsonResponse
    {
        $data = $request->only(['id', 'name', 'name_pet', 'cpf', 'email', 'phone', 'dt_birth']);
        if(self::send($data))
        {
            $storeNotify = $this->notify->store($data);
            return $storeNotify ? response()->json(['response' => 'Notificação recebida']) 
                : response()->json(['response' => 'Erro ao criar notificação']);
        }
        return response()->json(['response' => 'Erro ao enviar notificação']);
    }

    public function getAll() : JsonResponse
    {
        return response()->json($this->notify->getAll());
    }

    public function getNotify(Request $request) : JsonResponse
    {
        $id = (int) $request->get('id');
        return response()->json($this->notify->getNotify($id));
    }

    public function delete(Request $request) : JsonResponse
    {
        $id = (int) $request->get('id');
        return response()->json($this->notify->delete($id));
    }

    public function update(Request $request) : JsonResponse
    {
        $data = $request->only(['id', 'name', 'name_pet', 'cpf', 'email', 'phone', 'dt_birth']);
        return response()->json($this->notify->update($data));
    }
}
