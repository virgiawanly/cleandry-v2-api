<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Repositories\BaseResourceRepository;
use App\Services\BaseResourceService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BaseResourceController extends Controller
{
    /**
     * Base resource service.
     */
    protected BaseResourceService $service;

    /**
     * Create a new controller instance.
     */
    public function __construct(BaseResourceRepository $repository)
    {
        $this->service = new BaseResourceService($repository);
    }

    /**
     * Get all resources.
     */
    public function list(Request $request): JsonResponse
    {
        try {
            $resources = $this->service->list($request->all());
            return ResponseHelper::data($resources);
        } catch (Exception $e) {
            return ResponseHelper::internalServerError($e->getMessage(), 500);
        }
    }

    /**
     * Get paginated resources.
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $resources = $this->service->paginatedList($request->all());
            return ResponseHelper::data($resources);
        } catch (Exception $e) {
            return ResponseHelper::internalServerError($e->getMessage(), 500);
        }
    }

    /**
     * Get a resource by id.
     */
    public function show(int|string $id): JsonResponse
    {
        try {
            $resource = $this->service->find($id);
            return ResponseHelper::data($resource);
        } catch (ModelNotFoundException $e) {
            return ResponseHelper::notFound();
        } catch (Exception $e) {
            return ResponseHelper::internalServerError($e->getMessage(), 500);
        }
    }

    /**
     * Create a new resource.
     */
    public function save(Request $request): JsonResponse
    {
        try {
            $data = $this->service->save($request->validated());
            return ResponseHelper::data($data, null, 201);
        } catch (Exception $e) {
            return ResponseHelper::internalServerError($e->getMessage(), 500);
        }
    }

    /**
     * Update a resource.
     */
    public function patch(Request $request, int|string $id): JsonResponse
    {
        try {
            $data = $this->service->patch($id, $request->validated());
            return ResponseHelper::data($data);
        } catch (ModelNotFoundException $e) {
            return ResponseHelper::notFound();
        } catch (Exception $e) {
            return ResponseHelper::internalServerError($e->getMessage(), 500);
        }
    }

    /**
     * Delete a resource.
     */
    public function destroy(int|string $id): JsonResponse
    {
        try {
            $this->service->delete($id);
            return ResponseHelper::success('Resource deleted successfully.');
        } catch (ModelNotFoundException $e) {
            return ResponseHelper::notFound();
        } catch (Exception $e) {
            return ResponseHelper::internalServerError($e->getMessage(), 500);
        }
    }
}
