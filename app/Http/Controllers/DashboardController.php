<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;

class DashboardController extends Controller
{
    public string $route = 'pages.';
    public string $view = 'pages.';

    public function index()
    {
        return view('index');
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
