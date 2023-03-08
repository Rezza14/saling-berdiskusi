<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Services\PageService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Page\StorePageRequest;
use App\Http\Requests\Page\UpdatePageRequest;

class PageController extends Controller
{
    public string $route = 'page.';

    public string $view = 'pages.';

    public function index(PageService $PageService, Request $request)
    {
        try {
            $route = $this->route;
            $view = $this->view;
            $response = $PageService->index($request);
            if (!$response->success) {
                alert($response->message);

                return to_route('index')->withErrors($response->message);
            }
            $page = $response->data->with('user')->paginate(10)->withQueryString();

            return view($view . 'index', compact('page', 'view', 'route'));
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

    public function store(PageService $pagesServices, StorePageRequest $request)
    {
        try {
            $route = $this->route;
            $response = $pagesServices->store($request);
            if (!$response->success) {
                alert($response->message);

                return back()->withInput()->withErrors($response->message);
            }
            $page = $response->data;
            toastr($response->message);

            return redirect()->route($route . 'show', $page);
        } catch (Exception $e) {
            Log::emergency($e->getMessage());

            alert(__('whoops'));

            return back()->withInput()->withErrors(__('whoops'));
        }
    }

    public function pages(Page $page)
    {
        $route = $this->route;
        $view = $this->view;

        return view($view . 'pages', compact('page', 'view', 'route'));
    }

    public function show(Page $page)
    {
        $route = $this->route;
        $view = $this->view;

        return view($view . 'show', compact('page', 'view', 'route'));
    }

    public function edit(Page $page)
    {
        $route = $this->route;
        $view = $this->view;

        return view($view . 'edit', compact('view', 'page', 'route'));
    }

    public function update(PageService $PageService, UpdatePageRequest $request, Page $page)
    {
        try {
            $route = $this->route;
            $response = $PageService->update($request, $page);
            if (!$response->success) {
                alert($response->message);

                return back()->withInput()->withErrors($response->message);
            }
            $page = $response->data;
            toastr($response->message);

            return redirect()->route($route . 'show', $page);
        } catch (Exception $e) {
            Log::emergency($e->getMessage());

            alert(__('whoops'));

            return back()->withInput()->withErrors(__('whoops'));
        }
    }

    public function destroy(PageService $pagesService, Page $page)
    {
        try {
            $route = $this->route;
            $response = $pagesService->delete($page);
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
