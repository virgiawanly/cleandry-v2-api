<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceTypes\CreateServiceTypeRequest;
use App\Http\Requests\ServiceTypes\UpdateServiceTypeRequest;
use App\Repositories\ServiceTypeRepository;
use Illuminate\Http\JsonResponse;

class ServiceTypeController extends BaseResourceController
{
    /**
     * Create a new controller instance.
     */
    public function __construct(ServiceTypeRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateServiceTypeRequest $request): JsonResponse
    {
        return parent::save($request);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceTypeRequest $request, int|string $id): JsonResponse
    {
        return parent::patch($request, $id);
    }
}
