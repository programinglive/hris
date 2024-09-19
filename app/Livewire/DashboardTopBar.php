<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class DashboardTopBar extends Component
{
    public function logout(): void
    {
        auth()->logout();
        redirect('/');
    }

    public function render(): View
    {
        return view('livewire.dashboard-top-bar');
    }
}
