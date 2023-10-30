<?php

namespace App\Services\Interfaces;

interface IUserServices
{
    public function store(array $request) : array;

    public function getAll() : array;

    public function getUser(int $id) : array;

    public function delete(int $id) : array;

    public function update(array $request) : array;
}