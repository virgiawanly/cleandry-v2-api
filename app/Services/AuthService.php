<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthService
{
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
}
