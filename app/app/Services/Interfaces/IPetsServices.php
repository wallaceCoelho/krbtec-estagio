<?php

namespace App\Services\Interfaces;

interface IPetsServices
{
    public function store(array $request) : array;

    public function getAll() : array;

    public function getPet(int $id) : array;
    
    public function delete(int $id) : array;
}