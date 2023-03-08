<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateAvatarRequest;
use App\Http\Requests\Profile\UpdatePasswordRequest;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Services\ProfileService;
use Exception;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    protected string $route = 'profile.';

    protected string $view = 'profile.';

    public function index(ProfileService $profileService)
    {
        $route = $this->route;
        $view = $this->view;
        $response = $profileService->index();
        $user = $response->data;

        return view($view.'index', compact('route', 'view', 'user'));
    }

    public function update(ProfileService $profileService, UpdateProfileRequest $request)
    {
        try {
            $response = $profileService->updateProfile($request);
            if (! $response->success) {
                alert($response->message, 'error');

                return back()->withErrors($response->message);
            }
            toastr($response->message);

            return back();
        } catch (Exception $e) {
            Log::emergency($e->getMessage());

            alert(__('whoops'), 'error');

            return back()->withErrors(__('whoops'));
        }
    }

    public function updateAvatar(ProfileService $profileService, UpdateAvatarRequest $request)
    {
        try {
            $response = $profileService->updateAvatar($request);
            if (! $response->success) {
                alert($response->message, 'error');

                return back()->withErrors($response->message);
            }
            toastr($response->message);

            return back();
        } catch (Exception $e) {
            Log::emergency($e->getMessage());

            alert(__('whoops'), 'error');

            return back()->withErrors(__('whoops'));
        }
    }

    public function updatePassword(ProfileService $profileService, UpdatePasswordRequest $request)
    {
        try {
            $response = $profileService->updatePassword($request);
            if (! $response->success) {
                alert($response->message, 'error');

                return back()->withErrors($response->message);
            }
            toastr($response->message);

            return back();
        } catch (Exception $e) {
            Log::emergency($e->getMessage());

            alert(__('whoops'), 'error');

            return back()->withErrors(__('whoops'));
        }
    }
}
