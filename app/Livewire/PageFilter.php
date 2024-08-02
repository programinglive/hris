<?php

namespace App\Livewire;

use App\Models\Company;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class PageFilter extends Component
{
    #[Url(keep: true)]
    public $companyCode;

    public $filter = true;

    /**
     * Dispatches a 'setCompanyCode' event with the given company code.
     *
     * @param string $code The company code to be set.
     * @return void
     */
    public function updatedCompanyCode(string $code): void
    {
        $this->dispatch('setCompanyCode', $code);
    }

    #[On('disableFilter')]
    public function disableFilter(): void
    {
        $this->filter = false;
    }


    /**
     * Renders the view for the page filter.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.page-filter', [
            'companies' => Company::all()
        ]);
    }
}