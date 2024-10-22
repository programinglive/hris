<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class AttendanceLeavePage extends Component
{
    public $moduleLabel = 'Leave';

    /**
     * Renders the view for the brand page.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.attendance-leave-page')
            ->layout('components.layouts.dashboard');
    }
}
