<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class SubDivisionPage extends Component
{
    public $moduleLabel = 'Sub Division';

    /**
     * Renders the view for the unit page.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.sub-division-page')
            ->layout('components.layouts.dashboard');
    }
}