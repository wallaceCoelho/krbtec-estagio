<?php

namespace App\Services;

use App\Repository\Interfaces\IPetsRepository;
use App\Services\Interfaces\IPetsServices;

class PetsServices implements IPetsServices
{
    protected IPetsRepository $pets;

    public function __construct(IPetsRepository $pets) {
        $this->pets = $pets;
    }

    public function store(array $request) : array
    {
        return $this->pets->store($request);
    }
}