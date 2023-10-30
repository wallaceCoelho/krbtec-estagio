<?php

namespace App\Services\Interfaces;

interface IPetsServices
{
    public function store(array $request) : array;
}