<?php

namespace App\Repository\Interfaces;

interface IUserRepository
{
    public function getAll() : array;

    public function getUser(int $id) : array;

    public function store(array $request) : array;

    public function delete(int $id) : array;

    public function update(array $request) : array;
}