<?php

namespace App\Repositories\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseResourceRepositoryInterface
{
    /**
     * Get all resources.
     */
    public function list(array $queryParams = []): Collection;

    /**
     * Get all resources with pagination.
     */
    public function paginatedList(int $perPage, array $queryParams = []): LengthAwarePaginator;

    /**
     * Get a resource by id.
     */
    public function find(int|string $id): Model;

    /**
     * Create a new resource.
     */
    public function save(array $data): Model;

    /**
     * Update a resource.
     */
    public function update(int|string $id, array $data): Model;

    /**
     * Delete a resource.
     */
    public function delete(int|string $id): bool;
}
