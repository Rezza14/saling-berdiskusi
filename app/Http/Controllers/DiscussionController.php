<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Discussion;
use Illuminate\Http\Request;
use App\Services\DiscussionService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Discussion\StoreDiscussionRequest;
use App\Http\Requests\Discussion\UpdateDiscussionRequest;

class DiscussionController extends Controller
{
    public string $route = 'discussion.';

    public string $view = 'discussions.';

    public function index(DiscussionService $discussionService, Request $request)
    {
        try {
            $route = $this->route;
            $view = $this->view;
            $response = $discussionService->index($request);
            if (!$response->success) {
                alert($response->message);

                return to_route('index')->withErrors($response->message);
            }
            $discussion = $response->data->with('user')->paginate(10)->withQueryString();

            return view($view . 'index', compact('discussion', 'view', 'route'));
        } catch (Exception $e) {
            Log::emergency($e->getMessage());

            alert(__('whoops'));

            return to_route('index')->withErrors(__('whoops'));
        }
    }

    public function create()
    {
        $route = $this->route;
        $view = $this->view;

        return view($view . 'create', compact('view', 'route'));
    }

    public function store(DiscussionService $discussionService, StoreDiscussionRequest $request)
    {
        try {
            $route = $this->route;
            $response = $discussionService->store($request);
            if (!$response->success) {
                alert($response->message);

                return back()->withInput()->withErrors($response->message);
            }
            $discussion = $response->data;
            toastr($response->message);

            return redirect()->route($route . 'show', $discussion);
        } catch (Exception $e) {
            Log::emergency($e->getMessage());

            alert(__('whoops'));

            return back()->withInput()->withErrors(__('whoops'));
        }
    }

    public function show(Discussion $discussion)
    {
        $route = $this->route;
        $view = $this->view;

        $comments = $discussion->comments()->paginate(10);
        return view($view . 'show', compact('route', 'view', 'discussion', 'comments'));
    }

    public function edit(Discussion $discussion)
    {
        $route = $this->route;
        $view = $this->view;

        return view($view . 'edit', compact('view', 'discussion', 'route'));
    }

    public function update(DiscussionService $discussionService, UpdateDiscussionRequest $request, Discussion $discussion)
    {
        try {
            $route = $this->route;
            $response = $discussionService->update($request, $discussion);
            if (!$response->success) {
                alert($response->message);

                return back()->withInput()->withErrors($response->message);
            }
            $discussion = $response->data;
            toastr($response->message);

            return redirect()->route($route . 'show', $discussion);
        } catch (Exception $e) {
            Log::emergency($e->getMessage());

            alert(__('whoops'));

            return back()->withInput()->withErrors(__('whoops'));
        }
    }

    public function destroy(DiscussionService $discussionService, Discussion $discussion)
    {
        try {
            $route = $this->route;
            $response = $discussionService->delete($discussion);
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
