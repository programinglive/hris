<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class DashboardEmployeeCount extends Component
{
    public function render(): View
    {
        return view('livewire.dashboard-employee-count', [
            'employeesCount' => User::where(
                'name',
                '!=',
                'admin'
            )->count(),
        ]);
    }
}
