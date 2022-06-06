<?php

namespace App\View\Components;

use Illuminate\View\Component;

class breadcrumb extends Component
{
    public $title;
    public $linkTitle;

    public $title1;
    public $linkTitle1;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title,$linkTitle,$title1,$linkTitle1)
    {
        $this->title=$title;
        $this->linkTitle=$linkTitle;

        $this->title1=$title1;
        $this->linkTitle1=$linkTitle1;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.breadcrumb');
    }
}
