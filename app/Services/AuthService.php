<?php

namespace App\Services;

use App\Models\Outlet;
use App\Models\User;
use App\Repositories\OutletRepository;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthService
{
    /**
     * Outlet repository.
     */
    protected OutletRepository $outletRepository;

    /**
     * Create a new service instance.
     */
    public function __construct(OutletRepository $outletRepository)
    {
        $this->outletRepository = $outletRepository;
    }

    /**
     * Attempt to login the user.
     */
    public function login(array $payload): array
    {
        $user = User::where('username', $payload['username'])->first();

        if (!$user || !Hash::check($payload['password'], $user->password)) {
            throw new UnauthorizedHttpException('Sorry, your login details are invalid!');
        }

        if (!$user->is_active) {
            throw new UnauthorizedHttpException('Your account has been deactivated, please contact your administrator for further instructions.');
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        $user->update(['last_login_at' => now()]);

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    /**
     * Switch the current user outlet by creating a new token.
     */
    public function switchOutlet($payload): array
    {
        $authUser = auth()->user();

        if (!$authUser->can_access_multiple_outlet) {
            throw new AccessDeniedHttpException('You are not allowed to use this feature');
        }

        $outlet = Outlet::withoutCompanyScope()
            ->where('company_id', $authUser->company_id)
            ->where('id', $payload['outlet_id'])
            ->firstOrFail();

        $outletUser = $this->outletRepository->getUserOnAnotherOutlet($outlet, $authUser);

        if (!$outletUser) {
            $outletUser = $this->outletRepository->createOutletUser($outlet, $authUser);
        }

        $token = $outletUser->createToken('auth_token')->plainTextToken;
        $outletUser->update(['last_login_at' => now()]);

        return [
            'user' => $outletUser,
            'token' => $token,
        ];
    }
}
