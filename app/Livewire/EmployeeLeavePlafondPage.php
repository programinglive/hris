<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class EmployeeLeavePlafondPage extends Component
{
    public $moduleLabel = 'Employee Leave Plafond';

    /**
     * Renders the view for the employee page.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.employee-leave-plafond-page')
            ->layout('components.layouts.dashboard');
    }
}