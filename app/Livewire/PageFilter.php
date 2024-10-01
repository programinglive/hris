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
    public $companyCode = 'all';

    #[Url(keep: true)]
    public $branchCode = 'all';

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
            $this->dispatch('setCompany', 'all');
        } else {
            $this->dispatch('setCompany', $code);

            $this->companyId = Company::where('code', $code)->first()->id;

            $this->brands = Brand::where('company_id', $this->companyId)->get();
        }

    }

    /**
     * Sets the value of the company code property to the given code.
     *
     * @param  string  $code  The code to set as the company code.
     */
    #[On('setCompany')]
    public function setCompany(string $code): void
    {
        $this->companyCode = $code;
    }

    /**
     * Disables the filter by setting the 'filter' property to false.
     */
    /**
     * Disables the filter by setting the 'filter' property to false.
     */
    /**
     * Disables the filter by setting the 'filter' property to false.
     */
    #[On('disableFilter')]
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
