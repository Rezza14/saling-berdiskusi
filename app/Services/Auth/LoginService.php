<?php

namespace App\Services\Auth;

use App\Services\BaseService;
use App\Http\Requests\Auth\LoginRequest;
use Symfony\Component\HttpFoundation\Response;

class LoginService extends BaseService
{
    public function login(LoginRequest $request): object
    {
        $credentials = [
            'password' => $request->password,
        ];

        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $request->username;
        } else {
            $credentials['username'] = $request->username;
        }

        if (auth()->attempt($credentials, $request->has('remember'))) {
            $user = auth()->user();

            return $this->response(true, 'Successful login', $user);
        }

        return $this->response(false, 'Invalid Credentials', [
            'username' => 'User data not found',
        ], Response::HTTP_UNAUTHORIZED);
    }
}
