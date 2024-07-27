<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class PermissionPage extends Component
{
    public $moduleLabel = 'Permission';

    /**
     * Renders the view for the permission page.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.permission-page')
            ->layout('components.layouts.dashboard');
    }
}