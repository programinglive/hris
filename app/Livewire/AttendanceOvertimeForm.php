<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class AttendanceOvertimeForm extends Component
{
    public function render(): View
    {
        return view('livewire.attendance-overtime-form');
    }
}
