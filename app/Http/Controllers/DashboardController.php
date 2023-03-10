<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Discussion;
use Illuminate\Http\Request;
use App\Services\DiscussionService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public string $routeDiscussion = 'discussions.';

    public string $viewDiscussion = 'discussions.';

    public string $routePages = 'pages.';

    public string $viewPages = 'pages.';

    public function index(DiscussionService $discussionService, Request $request)
    {
        $discussionServiceResponse = $discussionService->index($request);
        if (!$discussionServiceResponse->success) {
            $discussion = [];
        } else {
            $discussion = $discussionServiceResponse->data->paginate(6)->withQueryString();
            $discussion->load('trixRichText');
            $discussion->load('user');
        }

        return view('index', compact('discussion'));
    }

    public function discussionCreate()
    {
        $route = $this->routeDiscussion;
        $view = $this->viewDiscussion;
        $user = Auth::user();

        return view($view . 'create', compact('view', 'route'));
    }

    public function discussionShow(Discussion $discussion)
    {
        $route = $this->routeDiscussion;
        $view = $this->viewDiscussion;

        $user = Auth()->user();
        $comments = $discussion->comments()->with('user')->orderByDesc('created_at')->get();
        $commentsCount = $discussion->comments()->count();

        return view($view . 'show', compact('route', 'view', 'discussion', 'comments', 'user', 'commentsCount'));
    }

    public function pageCreate()
    {
        $route = $this->routePages;
        $view = $this->viewPages;
        $user = Auth::user();

        return view($view . 'create', compact('view', 'route'));
    }

    public function pageShow(Page $page)
    {
        $route = $this->routePages;
        $view = $this->viewPages;

        return view($view . 'show', compact('page', 'route', 'view'));
    }
}
