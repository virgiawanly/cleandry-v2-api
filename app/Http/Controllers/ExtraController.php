<?php

namespace App\Http\Controllers;

use App\Http\Requests\Extras\CreateExtraRequest;
use App\Http\Requests\Extras\UpdateExtraRequest;
use App\Repositories\ExtraRepository;
use Illuminate\Http\JsonResponse;

class ExtraController extends BaseResourceController
{
    /**
     * Create a new controller instance.
     */
    public function __construct(ExtraRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateExtraRequest $request): JsonResponse
    {
        return parent::save($request);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExtraRequest $request, int|string $id): JsonResponse
    {
        return parent::patch($request, $id);
    }
}
