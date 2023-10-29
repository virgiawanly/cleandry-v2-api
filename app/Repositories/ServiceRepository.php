<?php

namespace App\Repositories;

use App\Models\Service;
use App\Repositories\Interfaces\ServiceRepositoryInterface;

class ServiceRepository extends BaseResourceRepository implements ServiceRepositoryInterface
{
    public function __construct()
    {
        $this->model = new Service();
    }
}
