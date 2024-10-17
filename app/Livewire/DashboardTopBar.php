<?php

namespace App\Livewire;

use App\Models\Company;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class DashboardTopBar extends Component
{
    public $branch;

    #[Url(keep: true)]
    public $branchCode;

    public $branchName;

    public $company;

    #[Url(keep: true)]
    public $companyCode;

    public $companyName;

    /**
     * mount event
     */
    public function mount(): void
    {
        $this->companyCode = $this->companyCode == '' ? 'all' : $this->companyCode;
        $this->branchCode = $this->branchCode == '' ? 'all' : $this->branchCode;

        session()->put('companyCode', $this->companyCode);
        session()->put('branchCode', $this->branchCode);
    }

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