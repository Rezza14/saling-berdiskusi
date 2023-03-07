<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DiscussionService;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __invoke(DiscussionService $discussionService, Request $request)
    {
        $response = $discussionService->index($request);
        $discussion = $response->data->with('user')->paginate(10)->withQueryString();

        return view('index', compact('discussion', 'view', 'route'));
    }
}
