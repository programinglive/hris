<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class CategoryPage extends Component
{
    public $moduleLabel = 'Category';

    /**
     * Renders the view for the brand page.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.category-page')
            ->layout('components.layouts.dashboard');
    }
}
