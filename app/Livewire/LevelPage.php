<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class LevelPage extends Component
{
    public $moduleLabel = 'Level';

    /**
     * Renders the view for the level page.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.level-page')
            ->layout('components.layouts.dashboard');
    }
}
