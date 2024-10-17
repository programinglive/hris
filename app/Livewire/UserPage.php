<?php

namespace App\Livewire;

use App\Models\Company;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class UserPage extends Component
{
    public $company;

    public $companyId;

    #[Url(keep: true)]
    public $companyCode;

    public $moduleLabel = 'User';



    /**
     * Sets the value of the company code property to the given code.
     *
     * @param string $companyCode  The code to set as the company code.
     */
    #[On('setCompany')]
    public function setCompany(string $companyCode): void
    {
        $this->companyCode = $companyCode;
        $this->company = Company::where('code', $companyCode)->first();
        $this->companyId = $this->company->id;
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