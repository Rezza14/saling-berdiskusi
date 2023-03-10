<?php

namespace App\Services;

use App\Http\Requests\Profile\UpdateAvatarRequest;
use App\Http\Requests\Profile\UpdatePasswordRequest;
use App\Http\Requests\Profile\UpdateProfileRequest;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ProfileService extends BaseService
{
    private ?string $oldImage = null;

    private ?string $newImage = null;

    public function index(): object
    {
        try {
            $user = auth()->user();

            return $this->response(true, 'Successfully get profile data', $user);
        } catch (Exception $e) {
            Log::emergency($e->getMessage());

            return $this->response(false, __('whoops'), $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateProfile(UpdateProfileRequest $request): object
    {
        DB::beginTransaction();
        try {
            $user = auth()->user();
            $user->update($request->validated());

            DB::commit();

            return $this->response(true, 'Successfuly updated profile data', $user);
        } catch (Exception $e) {
            DB::rollBack();
            Log::emergency($e->getMessage());

            return $this->response(false, __('whoops'), $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updatePassword(UpdatePasswordRequest $request): object
    {
        DB::beginTransaction();
        try {
            $user = auth()->user();
            if (!Hash::check($request->old_password, $user->password)) {
                return $this->response(false, 'Wrong old password', null, Response::HTTP_BAD_REQUEST);
            }

            $user->update(['password' => Hash::make($request->new_password)]);

            DB::commit();

            return $this->response(true, 'Successfully changed password');
        } catch (Exception $e) {
            DB::rollBack();

            Log::emergency($e->getMessage());

            return $this->response(false, __('whoops'), $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateAvatar(UpdateAvatarRequest $request): object
    {
        DB::beginTransaction();
        try {
            $user = auth()->user();
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $this->oldImage = $user->image;
                $this->newImage = $request->file('image')->store('image/users', 'public');
                $data['image'] = $this->newImage;
            }
            $user->update($data);
            DB::commit();
            DB::afterCommit(function () {
                if ($this->oldImage && Storage::disk('public')->exists($this->oldImage)) {
                    Storage::disk('public')->delete($this->oldImage);
                }
            });

            return $this->response(true, 'Successfully updated profile photo');
        } catch (Exception $e) {
            DB::rollBack();
            Log::emergency($e->getMessage());

            if ($this->newImage && Storage::disk('public')->exists($this->newImage)) {
                Storage::disk('public')->delete($this->newImage);
            }

            return $this->response(false, __('whoops'), $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
