<?php

namespace App\View\Components\Modal;

use Illuminate\View\Component;

class Staff extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $department;
    public $location;

    public function __construct($department, $location)
    {
        //
        $this->department = $department;
        $this->location = $location;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal.staff');
    }
}
