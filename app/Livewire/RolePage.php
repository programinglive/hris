<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class RolePage extends Component
{
    public $moduleLabel = 'Role';

    /**
     * Renders the view for the role page.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.role-page')
            ->layout('components.layouts.dashboard');
    }
}