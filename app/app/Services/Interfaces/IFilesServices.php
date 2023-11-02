<?php

namespace App\Services\Interfaces;

interface IFilesServices
{
    public function store(array $images) : array;

    public function get($imgName) : array;
}