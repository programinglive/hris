<?php

namespace App\Livewire;

use App\Models\Company;
use Illuminate\Contracts\View\View;
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
     *
     * @return void
     */
    public function mount(): void
    {
        $this->company = Company::first();
        $this->companyCode = $this->company->code;
        $this->companyName = $this->company->name;

        $this->branch = $this->company->branches()->first();
        $this->branchCode = $this->branch->code;
        $this->branchName = $this->branch->name;
    }

    /**
     * @param string $companyCode
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
    }


    /**
     * @return void
     */
    public function logout(): void
    {
        auth()->logout();
        redirect('/');
    }

    public function render(): View
    {
        return view('livewire.dashboard-top-bar', [
            'companies' => Company::all(),
            'branches' => $this->company->branches
        ]);
    }
}