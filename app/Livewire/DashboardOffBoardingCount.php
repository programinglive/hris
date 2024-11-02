<?php

namespace App\Livewire;

use App\Models\UserDetail;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class DashboardOffBoardingCount extends Component
{
    public function render(): View
    {
        return view('livewire.dashboard-off-boarding-count', [
            'offBoardingCount' => UserDetail::whereNotNull('date_out')
                ->whereNull('date_in')->count(),
        ]);
    }
}
