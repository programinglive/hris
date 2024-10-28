<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Company;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;

class DashboardTopBar extends Component
{
    #[Url(keep: true)]
    public $filterCompanyCode;

    #[Url(keep: true)]
    public $filterBranchCode;

    public $branches;

    /**
     * Mount the component
     */
    public function mount(): void
    {
        if ($this->filterCompanyCode != '') {
            $this->branches = Branch::where(
                'company_code', $this->filterCompanyCode
            )->get();
        }
    }

    /**
     * Triggered when the user changes the selected company
     */
    public function updatedFilterCompanyCode(string $companyCode): void
    {
        $this->branches = Branch::where(
            'company_code', $companyCode
        )->get();

        $this->dispatch('filter-company', $companyCode);
    }

    /**
     * Triggered when the user changes the selected branch
     */
    public function updatedFilterBranchCode(string $branchCode): void
    {
        $this->dispatch('filter-branch', $branchCode);
    }

    /**
     * Render the component.
     */
    public function render(): View
    {
        return view('livewire.dashboard-top-bar', [
            'companies' => Company::all(),
        ]);
    }
}