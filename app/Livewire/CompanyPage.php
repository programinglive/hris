<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;

class CompanyPage extends Component
{
    public $moduleLabel = 'Company';

    #[Url(keep: true)]
    public $companyCode = 'all';

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