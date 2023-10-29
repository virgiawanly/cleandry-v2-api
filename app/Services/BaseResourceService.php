<?php

namespace App\Services;

use App\Repositories\BaseResourceRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseResourceService
{
    /**
     * Base resource repository.
     */
    protected BaseResourceRepository $repository;

    /**
     * Default pagination size.
     *
     * @var int
     */
    protected $defaultPageSize = 10;

    /**
     * Create a new controller instance.
     */
    public function __construct(BaseResourceRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all resources.
     */
    public function list(array $queryParams): Collection
    {
        return $this->repository->list($queryParams);
    }

    /**
     * Get paginated resources.
     */
    public function paginatedList(array $queryParams): LengthAwarePaginator
    {
        $size =  array_key_exists('size', $queryParams)
            ? $queryParams['size']
            : $this->defaultPageSize;

        return $this->repository->paginatedList($size, $queryParams);
    }

    /**
     * Get a resource by id.
     */
    public function find(int|string $id): Model
    {
        return $this->repository->find($id);
    }

    /**
     * Create a new resource.
     */
    public function save(array $payload): Model
    {
        return $this->repository->save($payload);
    }

    /**
     * Update a resource.
     */
    public function patch(int|string $id, array $payload): Model
    {
        return $this->repository->update($id, $payload);
    }

    /**
     * Delete a resource.
     */
    public function delete(int|string $id): bool
    {
        return $this->repository->delete($id);
    }
}
