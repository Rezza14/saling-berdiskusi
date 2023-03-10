<?php

namespace App\Services;

use Exception;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Discussion\StoreDiscussionRequest;
use App\Http\Requests\Discussion\UpdateDiscussionRequest;

class DiscussionService extends BaseService
{
    private Discussion $discussion;

    public function __construct()
    {
        $this->discussion = new discussion();
    }

    public function index(Request $request): object
    {
        try {
            $discussion = $this->discussion->query();
            $discussion->orderByDesc('created_at');
            $discussion->when($request->filled('title'), function ($query) use ($request) {
                return $query->where('title', 'like', "%$request->title%");
            });

            return $this->response(true, 'Successfully get discussion data', $discussion);
        } catch (Exception $e) {
            Log::emergency($e->getMessage());

            return $this->response(false, __('whoops'), $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StoreDiscussionRequest $request): object
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $discussion = $this->discussion->create($data);
            DB::commit();

            return $this->response(true, 'Successfully added discussion data', $discussion);
        } catch (Exception $e) {
            DB::rollBack();
            Log::emergency($e->getMessage());

            return $this->response(false, __('whoops'), $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UpdatediscussionRequest $request, Discussion $discussion): object
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['updated_at'] = now();
            $discussion->update($data);
            DB::commit();

            return $this->response(true, 'Successfully changed discussion data', $discussion);
        } catch (Exception $e) {
            DB::rollback();
            Log::emergency($e->getMessage());

            return $this->response(false, __('whoops'), $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete(Discussion $discussion): object
    {
        DB::beginTransaction();
        try {
            $discussion->delete();
            DB::commit();

            return $this->response(true, 'Successfully deleted discussion data');
        } catch (Exception $e) {
            DB::rollback();
            Log::emergency($e->getMessage());

            return $this->response(false, __('whoops'), $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
