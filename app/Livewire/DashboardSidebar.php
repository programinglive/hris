<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class DashboardSidebar extends Component
{
    public function render(): View
    {
        return view('livewire.dashboard-sidebar');
    }
}
