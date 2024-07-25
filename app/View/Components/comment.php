<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class comment extends Component
{
    public $comment;
    public $datePosted;
    public $name;
    public $reply;
    public $commentid;
    public function __construct($comment, $datePosted, $name, $reply, $commentid)
    {
        $this->comment = $comment;
        $this->name=$name;
        $this->datePosted = $datePosted;
        $this->reply = $reply;
        $this->commentid = $commentid;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.comment');
    }
}