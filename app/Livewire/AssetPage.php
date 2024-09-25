<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class AssetPage extends Component
{
    public $moduleLabel = 'Asset';

    /**
     * Renders the view for the brand page.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.asset-page')
            ->layout('components.layouts.dashboard');
    }
}
