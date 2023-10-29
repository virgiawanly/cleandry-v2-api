<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customers\CreateCustomerRequest;
use App\Http\Requests\Customers\UpdateCustomerRequest;
use App\Repositories\CustomerRepository;
use Illuminate\Http\JsonResponse;

class CustomerController extends BaseResourceController
{
    /**
     * Create a new controller instance.
     */
    public function __construct(CustomerRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCustomerRequest $request): JsonResponse
    {
        return parent::save($request);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, int|string $id): JsonResponse
    {
        return parent::patch($request, $id);
    }
}
