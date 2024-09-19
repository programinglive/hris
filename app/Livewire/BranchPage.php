<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class BranchPage extends Component
{
    public $moduleLabel = 'Branch';

    public function render(): View
    {
        /**
         * Render the view for the branch page.
         *
         * @return View The rendered view.
         */
        return view('livewire.branch-page')
            ->layout('components.layouts.dashboard');
    }
}
