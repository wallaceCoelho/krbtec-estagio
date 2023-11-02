<?php

namespace App\Services;

use App\Repository\Interfaces\IUserRepository;
use App\Services\Interfaces\IUserServices;

class UserServices implements IUserServices
{
    protected IUserRepository $user;

    public function __construct(IUserRepository $user) {
        $this->user = $user;
    }

    public function store(array $request) : array
    {
        return $this->user->store($request);
    }

    public function getAll() : array
    {
        return $this->user->getAll();
    }

    public function getUser(int $id) : array
    {
        return $this->user->getUser($id);
    }

    public function delete(int $id) : array
    {
        return $this->user->delete($id);
    }

    public function update(array $request) : array 
    {
        return $this->user->update($request);
    }
}