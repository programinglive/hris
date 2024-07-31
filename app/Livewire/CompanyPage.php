<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class CompanyPage extends Component
{
    public $moduleLabel = 'Company';

    /**
     * Renders the view for the company page.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.company-page')
            ->layout('components.layouts.dashboard');
    }
}