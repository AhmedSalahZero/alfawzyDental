<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BlogComponent extends Component
{
    public $img;
    public $date;
    public $title;
    public $subtitle;
    public $id;
    public $description;
    public function __construct($img, $date, $title, $subtitle, $id, $description)
    {
        $this->img = $img;
        $this->date = $date;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->id = $id;
        $this->description = $description;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blogs.blog');
    }
}
