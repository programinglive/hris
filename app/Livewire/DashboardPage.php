<?php

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class DashboardPage extends Component
{
    /**
     * Render the view for the dashboard page.
     *
     * @return Application|Factory|View
     */
    public function render(): Application|Factory|View
    {
        return view('livewire.dashboard-page')->layout('components.layouts.dashboard');
    }
}