<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\Registrations\RegistrationRequest;
use App\Services\RegistrationService;
use Illuminate\Http\JsonResponse;

class RegistrationController extends Controller
{
    /**
     * Registration service.
     */
    protected RegistrationService $registrationService;

    /**
     * Create a new controller instance.
     */
    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    /**
     * Register a new user and create its first company and outlet.
     */
    public function register(RegistrationRequest $request): JsonResponse
    {
        try {
            $data = $this->registrationService->register($request);
            return ResponseHelper::success('Registration success', $data);
        } catch (\Exception $e) {
            return ResponseHelper::internalServerError($e->getMessage());
        }
    }
}
