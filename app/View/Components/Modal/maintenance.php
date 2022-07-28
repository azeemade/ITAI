<?php

namespace App\View\Components\modal;

use Illuminate\View\Component;

class maintenance extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $asset;

    public function __construct($asset)
    {
        //
        $this->asset = $asset;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal.maintenance');
    }
}
