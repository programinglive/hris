<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class UserPage extends Component
{
    #[Url(keep:true)]
    public $companyCode = 'all';

    public $moduleLabel = 'User';

    /**
     * Resets the 'companyCode' property to its initial value.
     *
     * This function is triggered when the 'resetCompanyCode' event is dispatched.
     *
     * @return void
     */
    #[On('resetCompanyCode')]
    public function resetCompanyCode(): void
    {
        $this->reset('companyCode');
    }

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