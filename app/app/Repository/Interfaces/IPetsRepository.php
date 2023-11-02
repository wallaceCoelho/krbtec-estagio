<?php

namespace App\Repository\Interfaces;


interface IPetsRepository
{
    public function getAll();

    public function getPet(int $id) : array;

    public function store(array $request) : array;

    public function delete(int $id);

    public function update(array $request) : array;
}