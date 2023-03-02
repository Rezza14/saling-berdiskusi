<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\LoginService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /**
     * Show the application's login form.
     *
     * @return Application|Factory|View
     */
    public function showLoginForm(): View|Factory|Application
    {
        return view('auth.login');
    }

    /**
     * Log in the user.
     */
    public function login(LoginRequest $request, LoginService $loginService): RedirectResponse
    {
        try {
            $loginResponse = $loginService->login($request);
            if (! $loginResponse->success) {
                alert($loginResponse->message, 'error');

                return redirect()
                ->back(302, [], route('login'))
                ->withInput()
                ->withErrors([
                    'message' => $loginResponse->message,
                ]);
            }

            toastr($loginResponse->message);

            return redirect()->intended(route('index'));
        } catch (Exception $e) {
            Log::emergency($e->getMessage());

            alert(__('whoops'), 'error');

            return redirect()->back(302, [], route('login'))->withInput();
        }
    }
}
