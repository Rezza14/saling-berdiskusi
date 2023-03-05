<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Redirector;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Application;

class LogoutController extends Controller
{
    public function __invoke(): Redirector|Application|RedirectResponse
    {
        auth()->logout();

        return redirect()->route('login');
    }
}
