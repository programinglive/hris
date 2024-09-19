<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class DivisionPage extends Component
{
    public $moduleLabel = 'Division';

    /**
     * Renders the view for the division page.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.division-page')
            ->layout('components.layouts.dashboard');
    }
}
