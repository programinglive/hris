<?php

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Component;

class PageHeader extends Component
{
    /**
     * Render the view for the component.
     *
     * @return Factory|Application|View
     */
    public function render(): Factory|Application|View
    {
        return view('livewire.page-header');
    }
}
