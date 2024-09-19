<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class BrandPage extends Component
{
    public $moduleLabel = 'Brand';

    /**
     * Renders the view for the brand page.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.brand-page')
            ->layout('components.layouts.dashboard');
    }
}
