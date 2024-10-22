<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class AttendanceOvertimePage extends Component
{
    public $moduleLabel = 'Overtime';

    /**
     * Renders the view for the brand page.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.attendance-overtime-page')
            ->layout('components.layouts.dashboard');
    }
}