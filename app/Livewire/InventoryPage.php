<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class InventoryPage extends Component
{
    public $moduleLabel = 'Inventory';

    /**
     * Renders the view for the brand page.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.inventory-page')
            ->layout('components.layouts.dashboard');
    }
}
