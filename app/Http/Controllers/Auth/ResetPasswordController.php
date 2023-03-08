<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Services\Auth\ResetPasswordService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, string $token): View|Factory|Application
    {
        $email = $request->query('email');

        return view('auth.reset', compact('email', 'token'));
    }

    public function reset(ResetPasswordRequest $request, ResetPasswordService $resetPasswordService): RedirectResponse
    {
        try {
            $resetPasswordResponse = $resetPasswordService->reset($request);
            if (!$resetPasswordResponse->success) {
                sweetAlert($resetPasswordResponse->data, 'error');

                return to_route('password.reset', [
                    'token' => $request->token,
                    'email' => $request->email,
                ])->withErrors($resetPasswordResponse->message);
            }

            toastr($resetPasswordResponse->message);

            return redirect()->route('login');
        } catch (Exception $e) {
            Log::emergency($e->getMessage());

            sweetAlert(__('whoops'), 'error');

            return back(302, [], route('password.reset', $request->token));
        }
    }
}
