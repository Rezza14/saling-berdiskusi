<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\Request;
use App\Services\DiscussionService;
use App\Http\Controllers\Controller;
use App\Models\Page;

class DashboardController extends Controller
{
    public string $route = 'pages.';
    public string $view = 'pages.';

    public function index()
    public string $route = 'discussions.';

    public string $view = 'discussions.';

    public function index(DiscussionService $discussionService, Request $request)
    {
        $discussionServiceResponse = $discussionService->index($request);
        if (! $discussionServiceResponse->success) {
            $discussion = [];
        } else {
            $discussion = $discussionServiceResponse->data->paginate(6)->withQueryString();
            $discussion->load('trixRichText');
            $discussion->load('user');
        }

        return view('index', compact('discussion'));
    }

    public function create()
    {
        $route = $this->route;
        $view = $this->view;

        return view($view . 'create', compact('view', 'route'));
    }

    public function show(Discussion $discussion)
    {
        $route = $this->route;
        $view = $this->view;

        $user = Auth()->user();
        $comments = $discussion->comments()->paginate(10);
        return view($view . 'show', compact('route', 'view', 'discussion', 'comments', 'user'));
    }

    public function pageCreate()
    {
        $route = $this->route;
        $view = $this->view;

        return view($view . 'create', compact('view', 'route'));
    }

    public function pageShow(Page $page)
    {
        $route = $this->route;
        $view = $this->view;

        return view($view . 'show', compact('page', 'route', 'view'));
    }

    public function pageCreate()
    {
        $route = $this->route;
        $view = $this->view;

        return view($view . 'create', compact('view', 'route'));
    }

    public function pageShow(Page $page)
    {
        $route = $this->route;
        $view = $this->view;

        return view($view . 'show', compact('page', 'route', 'view'));
    }
}
