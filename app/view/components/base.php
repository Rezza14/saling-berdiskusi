<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Base extends Component
{
    public ?string $title = null;

    public function __construct($title = null)
    {
        $this->title = $title;
    }

    public function render(): View
    {
        return view('layouts.base');
    }
}
