<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DataNotFound extends Component
{
    public $icon;
    public $message;
    public $help;
    public $button_name;
    public $button_link;
    public $button_icon;
    public $is_blank;
    public $loader;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $icon = null,
        $message = null,
        $help = null,
        $button_name = null,
        $button_link = null,
        $button_icon = null,
        $is_blank = null,
        $loader = null,
    )
    {
        $this->icon = $icon ?? 'fas fa-question';
        $this->message = $message ??  __("We couldn't find any data");
        $this->help = $help ?? __("Sorry we can't find any data, to get rid of this message, make at least 1 entry.");
        $this->button_name = $button_name;
        $this->button_link = $button_link;
        $this->button_icon = $button_icon;
        $this->is_blank = false ?? $is_blank;
        $this->loader = false ?? $loader;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.data-not-found');
    }
}
