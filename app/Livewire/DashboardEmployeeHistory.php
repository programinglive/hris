<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;

class DashboardEmployeeHistory extends Component
{
    #[Url(keep: true)]
    public $filterYear;

    public function render(): View
    {
        return view('livewire.dashboard-employee-history');
    }
}
