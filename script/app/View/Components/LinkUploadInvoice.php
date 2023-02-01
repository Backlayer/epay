<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LinkUploadInvoice extends Component
{
    public $id;
    public $type;
    public $file;
    public $invoiceNum;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $id,
        $type,
        $file,
        $invoiceNum,
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->file = $file;
        $this->invoiceNum = $invoiceNum;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.link-upload-file');
    }
}
