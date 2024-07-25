<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class post extends Component
{
    public $title;
    public $content;
    public $datePosted;
    public $id;
    public $username;
    public $userid;
    public $liked;
    public $class;
    public $nbLikes;
    public $sharable;
    public $followable;
    public $followed;
    public $followedClass;

    public function __construct($title, $content, $datePosted, $id, $username, $userid, $liked, $class, $nbLikes, $sharable, $followable, $followed, $followedClass)
    {
        $this->title = $title;
        $this->content = $content;
        $this->datePosted = $datePosted;
        $this->id = $id;
        $this->username = $username;
        $this->userid = $userid;
        $this->liked=$liked;
        $this->class=$class;
        $this->nbLikes=$nbLikes;
        $this->sharable=$sharable;
        $this->followable=$followable;
        $this->followed=$followed;
        $this->followedClass=$followedClass;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.post');
    }
}
