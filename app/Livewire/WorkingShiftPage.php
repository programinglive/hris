<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class WorkingShiftPage extends Component
{
    public $moduleLabel = 'Working Shift';

    /**
     * Renders the view for the brand page.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.working-shift-page')
            ->layout('components.layouts.dashboard');
    }
}