<?php

namespace App\Repositories;

use App\Models\Extra;
use App\Repositories\Interfaces\ExtraRepositoryInterface;

class ExtraRepository extends BaseResourceRepository implements ExtraRepositoryInterface
{
    /**
     * Create a new repository instance.
     */
    public function __construct()
    {
        $this->model = new Extra();
    }
}
