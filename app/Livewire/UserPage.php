<?php

namespace App\Livewire;

use App\Models\Company;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class UserPage extends Component
{
    #[Url(keep: true)]
    public $companyCode;

    #[Url(keep: true)]
    public $branchCode;

    public $moduleLabel = 'User';

    /**
     * Renders the view for the user page.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.user-page')
            ->layout('components.layouts.dashboard');
    }
}