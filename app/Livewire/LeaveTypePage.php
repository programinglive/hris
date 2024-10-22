<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class LeaveTypePage extends Component
{
    public $moduleLabel = 'Leave Type';

    /**
     * Renders the view for the brand page.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.leave-type-page')
            ->layout('components.layouts.dashboard');
    }
}
