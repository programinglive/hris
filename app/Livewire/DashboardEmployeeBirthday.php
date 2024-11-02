<?php

namespace App\Livewire;

use App\Models\UserDetail;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class DashboardEmployeeBirthday extends Component
{
    public function render(): View
    {
        return view('livewire.dashboard-employee-birthday', [
            'employees' => UserDetail::whereMonth('date_of_birth', now()->month)->get(),
        ]);
    }
}