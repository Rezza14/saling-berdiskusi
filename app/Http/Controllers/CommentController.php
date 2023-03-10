<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;

class CommentController extends Controller
{
    public string $route = 'comment.';

    public string $view = 'comments.';

    public function store(CommentService $commentService, StoreCommentRequest $request)
    {
        try {
            $route = $this->route;
            $response = $commentService->store($request);
            if (!$response->success) {
                alert($response->message);

                return back()->withInput()->withErrors($response->message);
            }
            $comment = $response->data;
            toastr($response->message);

            return redirect()->route($route . 'show', $comment);
        } catch (Exception $e) {
            Log::emergency($e->getMessage());

            alert(__('whoops'));

            return back()->withInput()->withErrors(__('whoops'));
        }
    }

    public function edit(Comment $comment)
    {
        $route = $this->route;
        $view = $this->view;

        return view($view . 'edit', compact('view', 'comment', 'route'));
    }

    public function update(CommentService $commentService, UpdateCommentRequest $request, Comment $comment)
    {
        try {
            $route = $this->route;
            $response = $commentService->update($request, $comment);
            if (!$response->success) {
                alert($response->message);

                return back()->withInput()->withErrors($response->message);
            }
            $comment = $response->data;
            toastr($response->message);

            return redirect()->route($route . 'show', $comment);
        } catch (Exception $e) {
            Log::emergency($e->getMessage());

            alert(__('whoops'));

            return back()->withInput()->withErrors(__('whoops'));
        }
    }

    public function destroy(CommentService $commentService, Comment $comment)
    {
        try {
            $route = $this->route;
            $response = $commentService->delete($comment);
            if (!$response->success) {
                alert($response->message);

                return to_route($route . 'index');
            }
            toastr($response->message);

            return back(302, [], route($route . 'index'));
        } catch (Exception $e) {
            Log::emergency($e->getMessage());

            alert(__('whoops'));

            return to_route('index');
        }
    }
}
