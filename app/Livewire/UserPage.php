<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class UserPage extends Component
{
    public $moduleLabel = 'User';

    /**
     * Renders the view for the role page.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.user-page')
            ->layout('components.layouts.dashboard');
    }
}