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

    #[Url(keep: true)]
    public $branchCode;

    public $filter = true;

    public $branchFilter = false;

    /**
     * Renders the view for the page filter.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.page-filter', [
            'companies' => Company::all(),
        ]);
    }
}
