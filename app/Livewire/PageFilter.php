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
    #[Url(keep:true)]
    public $companyCode;

    #[Url(keep:true)]
    public $brandCode;

    public $filter = true;

    public $companyId;

    public $branchFilter = false;

    public $brands;

    /**
     * Initializes the component by setting the company ID and brands based on the company code.
     *
     * @return void
     */
    public function mount(): void
    {
        if($this->companyCode != "") {
            $this->companyId = Company::where('code', $this->companyCode)->first()->id;

            $this->brands = Brand::where('company_id', $this->companyId)->get();
        }
    }

    /**
     * Dispatches a 'setBrandCode' event with the given brand code.
     *
     * @param string $code The brand code to be set.
     * @return void
     */
    public function updatedBrandCode(string $code): void
    {
        $this->dispatch('setBrandCode', $code);
    }

    /**
     * Dispatches a 'setCompanyCode' event with the given company code.
     *
     * @param string $code The company code to be set.
     * @return void
     */
    public function updatedCompanyCode(string $code): void
    {
        if($code != "") {
            $this->dispatch('setCompanyCode', $code);

            $this->companyId = Company::where('code', $code)->first()->id;

            $this->brands = Brand::where('company_id', $this->companyId)->get();
        }
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
            'companies' => Company::all(),
            'brands' => $this->brands
        ]);
    }
}