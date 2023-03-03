<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Services\Auth\ForgotPasswordService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class ForgotPasswordController extends Controller
{
    /**
     * Show forgot password form.
     *
     * @return Factory|View|Application
     */
    public function showLinkRequestForm(): Factory|View|Application
    {
        return view('auth.forgot');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  ForgotPasswordRequest  $request
     * @param  ForgotPasswordService  $forgotPasswordService
     * @return RedirectResponse
     */
    public function sendResetLinkEmail(ForgotPasswordRequest $request, ForgotPasswordService $forgotPasswordService): RedirectResponse
    {
        try {
            $forgotPasswordResponse = $forgotPasswordService->sendResetLinkEmail($request);
            if (!$forgotPasswordResponse->success) {
                sweetalert($forgotPasswordResponse->data, 'error');

                return back(302, [], route('forgot-password'))
                    ->withErrors($forgotPasswordResponse->message);
            }

            toastr($forgotPasswordResponse->message);

            return back(302, [], route('forgot-password'));
        } catch (Exception $e) {
            Log::emergency($e->getMessage());

            sweetalert(__('whoops'), 'error');

            return redirect()->back(302, [], route('forgot-password'))->withInput();
        }
    }
}
