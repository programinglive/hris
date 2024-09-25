<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class PositionPage extends Component
{
    public $moduleLabel = 'Position';

    /**
     * Renders the view for the position page.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.position-page')
            ->layout('components.layouts.dashboard');
    }
}
