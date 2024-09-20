<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class SubCategoryPage extends Component
{
    public $moduleLabel = 'Sub Category';

    /**
     * Renders the view for the brand page.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.sub-category-page')
            ->layout('components.layouts.dashboard');
    }
}