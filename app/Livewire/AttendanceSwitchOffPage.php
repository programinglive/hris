<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class AttendanceSwitchOffPage extends Component
{
    public $moduleLabel = 'Switch Off';

    /**
     * Renders the view for the brand page.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.attendance-switch-off-page')
            ->layout('components.layouts.dashboard');
    }
}
