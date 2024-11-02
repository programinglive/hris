<?php

namespace App\Livewire;

use App\Models\UserDetail;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class DashboardProbationCount extends Component
{
    public function render(): View
    {
        return view('livewire.dashboard-probation-count', [
            'probationCount' => UserDetail::whereNotNull('date_in')
                ->whereNull('date_out')->count(),
        ]);
    }
}
