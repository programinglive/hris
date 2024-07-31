<?php

namespace App\Livewire;

use App\Models\Company;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;

class PageFilter extends Component
{
    #[Url(keep: true)]
    public $companyCode;

    public function updatedCompanyCode($code)
    {
        $this->dispatch('setCompanyCode', $code);
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