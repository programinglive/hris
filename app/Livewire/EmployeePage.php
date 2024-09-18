<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class EmployeePage extends Component
{
    public $moduleLabel = 'Employee';

    /**
     * Renders the view for the employee page.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.employee-page')
            ->layout('components.layouts.dashboard');
    }
}