<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class AttendanceTimePage extends Component
{
    public $moduleLabel = 'Time';

    /**
     * Renders the view for the brand page.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.attendance-time-page')
            ->layout('components.layouts.dashboard');
    }
}
