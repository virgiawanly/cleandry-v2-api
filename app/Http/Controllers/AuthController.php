<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SwitchOutletRequest;
use App\Services\AuthService;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthController extends Controller
{
    /**
     * Auth service.
     */
    protected AuthService $authService;

    /**
     * Create a new controller instance.
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Attempt to login the user.
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $data = $this->authService->login($request->validated());
            return ResponseHelper::data($data);
        } catch (UnauthorizedHttpException $e) {
            return ResponseHelper::unauthorized($e->getMessage());
        } catch (Exception $e) {
            return ResponseHelper::internalServerError($e->getMessage());
        }
    }

    /**
     * Switch the current user outlet by creating a new token.
     */
    public function switchOutlet(SwitchOutletRequest $request): JsonResponse
    {
        try {
            $data = $this->authService->switchOutlet($request->validated());
            return ResponseHelper::data($data);
        } catch (AccessDeniedHttpException $e) {
            return ResponseHelper::unauthorized($e->getMessage());
        } catch (Exception $e) {
            return ResponseHelper::internalServerError($e->getMessage());
        }
    }
}
