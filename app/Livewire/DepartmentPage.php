<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class DepartmentPage extends Component
{
    public $moduleLabel = 'Department';

    /**
     * Renders the view for the department page.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.department-page')
            ->layout('components.layouts.dashboard');
    }
}