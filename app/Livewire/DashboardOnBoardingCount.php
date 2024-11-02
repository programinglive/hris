<?php

namespace App\Livewire;

use App\Models\UserDetail;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class DashboardOnBoardingCount extends Component
{
    public function render(): View
    {
        return view('livewire.dashboard-on-boarding-count', [
            'onBoardingCount' => UserDetail::whereNotNull('date_in')
                ->whereNull('date_out')->count(),
        ]);
    }
}
