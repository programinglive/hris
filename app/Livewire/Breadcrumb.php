<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class Breadcrumb extends Component
{
    public $moduleLabel;

    /**
     * Render the view for the breadcrumb component.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.breadcrumb');
    }
}