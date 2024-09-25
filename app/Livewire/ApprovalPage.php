<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class ApprovalPage extends Component
{
    public $moduleLabel = 'Approval';

    /**
     * Renders the view for the brand page.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.approval-page')
            ->layout('components.layouts.dashboard');
    }
}