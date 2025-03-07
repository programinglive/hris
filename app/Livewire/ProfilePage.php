<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class ProfilePage extends Component
{
    public $moduleLabel = 'Profile';

    /**
     * Renders the view for the brand page.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.profile-page')
            ->layout('components.layouts.dashboard');
    }
}
