<?php

namespace App\Http\Controllers;

use App\Http\Requests\Services\CreateServiceRequest;
use App\Http\Requests\Services\UpdateServiceRequest;
use App\Repositories\ServiceRepository;
use Illuminate\Http\JsonResponse;

class ServiceController extends BaseResourceController
{
    /**
     * Create a new controller instance.
     */
    public function __construct(ServiceRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateServiceRequest $request): JsonResponse
    {
        return parent::save($request);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, int|string $id): JsonResponse
    {
        return parent::patch($request, $id);
    }
}
