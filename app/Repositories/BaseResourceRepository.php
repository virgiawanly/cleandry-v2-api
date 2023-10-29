<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseResourceRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseResourceRepository implements BaseResourceRepositoryInterface
{
    protected Model $model;

    /**
     * Create a new class instance.
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all resources.
     */
    public function list(array $queryParams = []): Collection
    {
        $search = array_key_exists('search', $queryParams)
            ? $queryParams['search']
            : '';
        $sortBy = array_key_exists('sort', $queryParams)
            ? $queryParams['sort']
            : '';
        $sortOrder = array_key_exists('order', $queryParams)
            ? (str_contains($queryParams['order'], 'asc') ? 'asc' : 'desc')
            : '';

        return $this->model
            ->search($search)
            ->ofOrder($sortBy, $sortOrder)
            ->get();
    }

    /**
     * Get all resources with pagination.
     */
    public function paginatedList(int $perPage, array $queryParams = []): LengthAwarePaginator
    {
        $search = array_key_exists('search', $queryParams)
            ? $queryParams['search']
            : '';
        $sortBy = array_key_exists('sort', $queryParams)
            ? $queryParams['sort']
            : '';
        $sortOrder = array_key_exists('order', $queryParams)
            ? (str_contains($queryParams['order'], 'asc') ? 'asc' : 'desc')
            : '';

        return $this->model
            ->search($search)
            ->ofOrder($sortBy, $sortOrder)
            ->paginate($perPage);
    }

    /**
     * Get a resource by id.
     */
    public function find(int|string $id): Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Create a new resource.
     */
    public function save(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * Update a resource.
     */
    public function update(int|string $id, array $data): Model
    {
        $resource = $this->model->findOrFail($id);
        $resource->update($data);

        return $resource;
    }

    /**
     * Delete a resource.
     */
    public function delete(int|string $id): bool
    {
        $resource = $this->model->findOrFail($id);

        return $resource->delete();
    }
}
