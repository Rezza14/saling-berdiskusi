<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public string $route = 'user.';

    public string $view = 'user.';

    public function index(UserService $userService, Request $request)
    {
        try {
            $route = $this->route;
            $view = $this->view;
            $response = $userService->index($request);
            if (!$response->success) {
                sweetAlert($response->message, 'error');

                return to_route('index')->withErrors($response->message);
            }
            $users = $response->data->with(['roles'])->paginate(10)->withQueryString();

            return view($view . 'index', compact('users', 'view', 'route'));
        } catch (Exception $e) {
            Log::emergency($e->getMessage());

            sweetAlert(__('whoops'), 'error');

            return to_route('index')->withErrors(__('whoops'));
        }
    }

    public function create()
    {
        $route = $this->route;
        $view = $this->view;

        return view($view . 'create', compact('view', 'route'));
    }

    public function store(UserService $userService, StoreUserRequest $request)
    {
        try {
            $route = $this->route;
            $response = $userService->store($request);
            if (!$response->success) {
                sweetAlert($response->message, 'error');

                return back()->withInput()->withErrors($response->message);
            }
            $users = $response->data;
            toastr($response->message);

            return redirect()->route($route . 'show', $users);
        } catch (Exception $e) {
            Log::emergency($e->getMessage());

            sweetAlert(__('whoops'), 'error');

            return back()->withInput()->withErrors(__('whoops'));
        }
    }

    public function show(User $user)
    {
        $route = $this->route;
        $view = $this->view;

        return view($view . 'show', compact('user', 'view', 'route'));
    }

    public function edit(User $user)
    {
        $route = $this->route;
        $view = $this->view;

        return view($view . 'edit', compact('user', 'view', 'route'));
    }

    public function update(UserService $userService, UpdateUserRequest $request, User $user)
    {
        try {
            $route = $this->route;
            $response = $userService->update($request, $user);
            if (!$response->success) {
                sweetAlert($response->message, 'error');

                return back()->withInput()->withErrors($response->message);
            }
            $user = $response->data;
            toastr($response->message);

            return redirect()->route($route . 'show', $user);
        } catch (Exception $e) {
            Log::emergency($e->getMessage());

            sweetAlert(__('whoops'), 'error');

            return back()->withInput()->withErrors(__('whoops'));
        }
    }

    public function destroy(UserService $userService, User $user)
    {
        try {
            $response = $userService->delete($user);
            if (!$response->success) {
                SweetAlert($response->message, 'error');

                return to_route($this->route . 'index');
            }

            toastr($response->message);

            return to_route($this->route . 'index');
        } catch (Exception $e) {
            Log::emergency($e->getMessage());

            SweetAlert(__('whoops'), 'error');

            return to_route('index');
        }
    }
}
