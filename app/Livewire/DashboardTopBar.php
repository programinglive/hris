<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Company;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class DashboardTopBar extends Component
{
    public $company;
    public $companyId;

    #[Url(keep: true)]
    public $companyCode;

    public $companyName;

    public $branch;
    public $branchId;

    #[Url(keep: true)]
    public $branchCode;

    public $branchName;

    /**
     * Set the company based on the company code
     *
     * @param string $companyCode
     * @return void
     */
    #[On('setCompany')]
    public function setCompany(string $companyCode): void
    {
        $this->company = Company::where('code', $companyCode)->first();
        $this->companyCode = $companyCode;
    }


    /**
     * Set the branch based on the branch code
     *
     * @param string $branchCode
     * @return void
     */
    #[On('setBranch')]
    public function setBranch(string $branchCode): void
    {
        $this->branchCode = $branchCode;

        if ($branchCode != 'all') {
            $this->branch = Branch::where('code', $branchCode)->first();
            $this->branchId = $this->branch->id;
        }
    }

    /**
     * Company code updated event
     */
    public function updatedCompanyCode(string $companyCode): void
    {
        $this->resetErrorBag();

        if ($companyCode == '') {
            $this->addError('companyCode', 'This field is required');
            $this->dispatch('resetCompanyId');
            $this->companyCode = 'all';

            return;
        }

        $this->companyCode = $companyCode;

        $this->dispatch('setCompany', $companyCode);
        $this->dispatch('resetError');
    }

    public function render(): View
    {
        return view('livewire.dashboard-top-bar', [
            'companies' => Company::all(),
            'branches' => $this->company?->branches,
        ]);
    }
}