<?php

namespace App\Services\Auth;

use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Services\BaseService;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ResetPasswordService extends BaseService
{
    /**
     * Reset the password for the given token.
     */
    public function reset(ResetPasswordRequest $request): object
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET
            ? $this->response(true, __('passwords.reset'), __($status))
            : $this->response(false, __($status), [
                'email' => [__($status)],
            ], Response::HTTP_UNAUTHORIZED);
    }
}
