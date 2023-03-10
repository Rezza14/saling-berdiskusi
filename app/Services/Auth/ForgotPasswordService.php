<?php

namespace App\Services\Auth;

use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Services\BaseService;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpFoundation\Response;
use Validator;
use Str;

class ForgotPasswordService extends BaseService
{
    public function sendResetLinkEmail(ForgotPasswordRequest $request): object
    {
        $status = Password::sendResetLink(
            $request->only(['email'])
        );

        return $status == Password::RESET_LINK_SENT
            ? $this->response(true, 'Password reset link has been sent to your email.')
            : $this->response(false, 'An error occurred while sending the reset password link.', [
                'email' => __($status),
            ], Response::HTTP_UNAUTHORIZED);
    }

    public function resetPassword(Request $request, string $token): object
    {
        $rules = [
            'email' => app()->isProduction() ? 'required|email:rfc,dns,spoof' : 'required|email',
            'password' => 'required|min:8|confirmed',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->response(false, implode(',', $validator->messages()->all()), $validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $status = Password::reset(
            array_merge($request->only('email', 'password', 'password_confirmation'), ['token' => $token]),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET
            ? $this->response(true, 'Password reseted successfully', __($status))
            : $this->response(false, 'Failed to reset password', __($status), Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
