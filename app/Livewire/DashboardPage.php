<?php

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Url;
use Livewire\Component;

class DashboardPage extends Component
{
    #[Url(keep: true)]
    public $companyCode;

    /**
     * Render the view for the dashboard page.
     */
    public function render(): Application|Factory|View
    {
        return view('livewire.dashboard-page')
            ->layout('components.layouts.dashboard');
    }
}
