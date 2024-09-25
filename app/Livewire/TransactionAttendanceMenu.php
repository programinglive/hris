<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class TransactionAttendanceMenu extends Component
{
    /**
     * Renders the attendance menu view.
     *
     * @return View The rendered attendance menu view.
     */
    public function render(): View
    {
        return view('livewire.transaction-attendance-menu');
    }
}
