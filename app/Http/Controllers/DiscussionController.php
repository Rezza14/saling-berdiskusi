<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Services\DiscussionService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Discussion\StoreDiscussionRequest;
use App\Http\Requests\Discussion\UpdateDiscussionRequest;
use Auth;
use Exception;

class DiscussionController extends Controller
{
    public string $route = 'discussions.';

    public string $view = 'discussions.';

    public function store(DiscussionService $discussionService, StoreDiscussionRequest $request)
    {
        try {
            $route = $this->route;
            $response = $discussionService->store($request);
            if (!$response->success) {
                sweetalert($response->message);

                return back()->withInput()->withErrors($response->message);
            }
            $discussion = $response->data;
            toastr($response->message);

            return redirect()->route($route . 'show', $discussion);
        } catch (Exception $e) {
            Log::emergency($e->getMessage());

            sweetalert(__('whoops'), 'error');

            return back()->withInput()->withErrors(__('whoops'));
        }
    }

    public function edit(Discussion $discussion)
    {
        $route = $this->route;
        $view = $this->view;

        if (Auth::user()->id != $discussion->user_id) {
            abort(403);
        }
        return view($view . 'edit', compact('view', 'discussion', 'route'));
    }

    public function update(DiscussionService $discussionService, UpdateDiscussionRequest $request, Discussion $discussion)
    {
        try {
            $route = $this->route;
            $response = $discussionService->update($request, $discussion);
            if (!$response->success) {
                sweetalert($response->message);

                return back()->withInput()->withErrors($response->message);
            }
            $discussion = $response->data;
            toastr($response->message);

            return redirect()->route($route . 'show', $discussion);
        } catch (Exception $e) {
            Log::emergency($e->getMessage());

            sweetalert(__('whoops'), 'error');

            return back()->withInput()->withErrors(__('whoops'));
        }
    }

    public function destroy(DiscussionService $discussionService, Discussion $discussion)
    {
        try {
            $response = $discussionService->delete($discussion);
            if (!$response->success) {
                sweetalert($response->message);

                return to_route('index');
            }
            toastr($response->message);

            return redirect()->route('index');
        } catch (Exception $e) {
            Log::emergency($e->getMessage());

            sweetalert(__('whoops'), 'error');

            return to_route('index');
        }
    }
}
