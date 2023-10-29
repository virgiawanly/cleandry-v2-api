<?php

namespace App\Repositories;

use App\Models\ServiceType;
use App\Repositories\Interfaces\ServiceTypeRepositoryInterface;

class ServiceTypeRepository extends BaseResourceRepository implements ServiceTypeRepositoryInterface
{
    public function __construct()
    {
        $this->model = new ServiceType();
    }
}
