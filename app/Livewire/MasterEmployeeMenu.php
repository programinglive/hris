<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class MasterEmployeeMenu extends Component
{
    /**
     * Renders the 'master-employee-menu' view.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.master-employee-menu');
    }
}