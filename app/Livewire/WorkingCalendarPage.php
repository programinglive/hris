<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class WorkingCalendarPage extends Component
{
    public $moduleLabel = 'Working Calendar';

    /**
     * Renders the view for the brand page.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.working-calendar-page')
            ->layout('components.layouts.dashboard');
    }
}
