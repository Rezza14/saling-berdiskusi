<?php

namespace App\Services;

use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Models\Comment;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CommentService extends BaseService
{
    private Comment $comment;

    public function __construct()
    {
        $this->comment = new comment();
    }

    public function store(StoreCommentRequest $request): object
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $comment = $this->comment->create($data);
            DB::commit();

            return $this->response(true, 'Successfully added comment data', $comment);
        } catch (Exception $e) {
            DB::rollBack();
            Log::emergency($e->getMessage());

            return $this->response(false, __('whoops'), $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UpdateCommentRequest $request, Comment $comment): object
    {
        DB::beginTransaction();
        try {
            $comment->update($request->validated());
            DB::commit();

            return $this->response(true, 'Successfully changed comment data', $comment);
        } catch (Exception $e) {
            DB::rollback();
            Log::emergency($e->getMessage());

            return $this->response(false, __('whoops'), $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete(Comment $comment): object
    {
        DB::beginTransaction();
        try {
            $comment->delete();
            DB::commit();

            return $this->response(true, 'Successfully deleted comment data');
        } catch (Exception $e) {
            DB::rollback();
            Log::emergency($e->getMessage());

            return $this->response(false, __('whoops'), $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
