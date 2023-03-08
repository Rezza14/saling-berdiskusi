<?php

namespace App\Services;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Symfony\Component\HttpFoundation\Response;

class UserService extends BaseService
{
    private User $user;

    private ?string $oldImage = null;

    private ?string $newImage = null;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index(Request $request): object
    {
        try {
            $users = $this->user->query();
            $users->when($request->filled('name'), function ($query) use ($request) {
                return $query->where('name', 'like', "%$request->name%");
            });

            return $this->response(true, 'Successfully get data user', $users);
        } catch (Exception $e) {
            Log::emergency($e->getMessage());

            return $this->response(false, __('whoops'), $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StoreUserRequest $request): object
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);
            if ($request->hasFile('image')) {
                $this->newImage = $request->file('image')->store('image/users', 'public');
                $data['image'] = $this->newImage;
            }
            $user = $this->user->create($data);
            if ($request->filled('role')) {
                $user->syncRoles($request->role);
            }
            DB::commit();

            return $this->response(true, 'Successfully added user data', $user);
        } catch (Exception $e) {
            DB::rollback();
            Log::emergency($e->getMessage());

            if (!empty($this->newImage) && Storage::disk('public')->exists($this->newImage)) {
                Storage::disk('public')->delete($this->newImage);
            }

            return $this->response(false, __('whoops'), $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UpdateUserRequest $request, User $user): object
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['password'] = $request->filled('password') ? Hash::make($data['password']) : $user->password;
            if ($request->hasFile('image')) {
                $this->oldImage = $user->image;
                $this->newImage = $request->file('image')->store('image/users', 'public');
                $data['image'] = $this->newImage;
            }
            $user->update($data);
            if ($request->filled('role')) {
                $user->syncRoles($request->role);
            }
            DB::commit();
            DB::afterCommit(function () {
                if (!empty($this->oldImage) && Storage::disk('public')->exists($this->oldImage)) {
                    Storage::disk('public')->delete($this->oldImage);
                }
            });

            return $this->response(true, 'Successfully updated user data', $user);
        } catch (Exception $e) {
            DB::rollBack();

            Log::emergency($e->getMessage());

            if (!empty($this->newImage) && Storage::disk('public')->exists($this->newImage)) {
                Storage::disk('public')->delete($this->newImage);
            }

            return $this->response(false, __('whoops'), $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete(User $user): object
    {
        DB::beginTransaction();
        try {
            if ($user->is(Auth::user())) {
                return $this->response(false, 'You can\'t delete your own account', Response::HTTP_FORBIDDEN);
            }
            $this->oldImage = $user->image;
            $user->delete();
            DB::commit();
            DB::afterCommit(function () {
                if (!empty($this->oldImage) && Storage::disk('public')->exists($this->oldImage)) {
                    Storage::disk('public')->delete($this->oldImage);
                }
            });

            return $this->response(true, 'Successfully deleted user data');
        } catch (Exception $e) {
            DB::rollBack();

            Log::emergency($e->getMessage());

            return $this->response(false, __('whoops'), $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
