<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Company;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class PageFilter extends Component
{
    #[Url(keep: true)]
    public $companyCode;

    #[Url(keep: true)]
    public $branchCode;

    public $filter = true;

    public $companyId;

    public $branchFilter = false;

    public $brands;

    /**
     * Initializes the component by setting the company ID and brands based on the company code.
     */
    public function mount(): void
    {
        $this->companyCode = $this->companyCode == '' ? 'all' : $this->companyCode;

        if ($this->companyCode != 'all') {

            if (! Company::where('code', $this->companyCode)->first()) {
                abort(404);
            }

            $this->companyId = Company::where('code', $this->companyCode)->first()->id;
            $this->brands = Brand::where('company_id', $this->companyId)->get();
        }
    }

    /**
     * Dispatches a 'setBrandCode' event with the given brand code.
     *
     * @param  string  $code  The brand code to be set.
     */
    public function updatedBrandCode(string $code): void
    {
        $this->dispatch('setBrandCode', $code);
    }

    /**
     * Dispatches a 'setCompany' event with the given company code.
     *
     * @param  string  $code  The company code to be set.
     */
    public function updatedCompanyCode(string $code): void
    {
        if ($code == 'all') {
            $this->dispatch('set-company', 'all');
        } else {
            $this->dispatch('set-company', $code);

            $this->companyId = Company::where('code', $code)->first()->id;

            $this->brands = Brand::where('company_id', $this->companyId)->get();
        }

    }

    /**
     * Sets the company ID based on the provided code.
     *
     * @param  string  $code  The code of the company.
     */
    #[On('set-company')]
    public function setCompany(string $code): void
    {
        if ($code != 'all') {
            $this->companyCode = $code;
            $this->companyId = Company::where('code', $code)->first()->id;
        } else {
            $this->companyCode = 'all';
        }
    }

    /**
     * Disables the filter by setting the 'filter' property to false.
     */
    #[On('disable-filter')]
    public function disableFilter(): void
    {
        $this->filter = false;
    }

    /**
     * Enables the filter by setting the 'filter' property to true.
     */
    #[On('enableFilter')]
    public function enableFilter(): void
    {
        $this->filter = true;
    }

    /**
     * Renders the view for the page filter.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.page-filter', [
            'companies' => Company::all(),
            'brands' => $this->brands,
        ]);
    }
}
