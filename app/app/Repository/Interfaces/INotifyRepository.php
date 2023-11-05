<?php

namespace App\Repository\Interfaces;


interface INotifyRepository
{
    public function getAll();

    public function getNotify(int $id) : array;

    public function store(array $request) : bool;

    public function delete(int $id);

    public function update(array $request) : array;
}