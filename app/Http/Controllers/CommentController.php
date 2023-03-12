<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Discussion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public string $route = 'discussions.';

    public string $view = 'discussions.';

    public function store(Request $request, Discussion $discussion)
    {
        $route = $this->route;

        $request->validate([
            'comment' => 'required',
        ]);

        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->user_id = Auth::id();
        $comment->discussion_id = $discussion->id;
        $comment->save();

        return redirect()->route($route . 'show', $discussion);
    }

    public function edit(Comment $comment)
    {
        $route = $this->route;
        $view = $this->view;
        $user = Auth::user();

        if ($user->id != $comment->user_id) {
            abort(403);
        } elseif (Auth::user()->getRoleNames()->implode('') != 'administrator')
            return view($view . 'editComments', compact('view', 'comment', 'route'));
    }

    public function update(Request $request, Comment $comment)
    {
        $route = $this->route;
        $user = Auth::user();

        if ($user->id != $comment->user_id) {
            abort(403);
        }
        $data['comment'] = $request->comment;
        $comment->update($data);
        $discussion_id = $comment->discussion_id;
        return redirect()->route($route . 'show', $discussion_id);
    }

    public function destroy(Comment $comment)
    {
        $route = $this->route;
        $user = Auth::user();

        if ($user->id == $comment->user_id) {
            $comment->delete();
            $discussion_id = $comment->discussion_id;
            return redirect()->route($route . 'show', $discussion_id);
        } elseif ($user->Admin()) {
            $comment->delete();
            $discussion_id = $comment->discussion_id;
            return redirect()->route($route . 'show', $discussion_id);
        } elseif ($user->id == $comment->discussion->user_id) {
            $comment->delete();
            $discussion_id = $comment->discussion_id;
            return redirect()->route($route . 'show', $discussion_id);
        }
        abort(403);
    }
}
