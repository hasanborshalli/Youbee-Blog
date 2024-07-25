<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class toast extends Component
{
    /**
     * Create a new component instance.
     */
    public $content;
    public function __construct($content)
    {
        $this->content=$content;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.toast');
    }
}