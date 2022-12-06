<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AdminCanUpdate extends Component
{
    public $text;
    public $url;
    public $class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($text, $url, $class = 'btn btn-outline-dark')
    {
        $this->text = $text;
        $this->url = $url;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin-can-update');
    }
}
