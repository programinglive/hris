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
     */
    public function mount(): void
    {
        $this->companyCode = $this->companyCode == '' ? 'all' : $this->companyCode;
        $this->branchCode = $this->branchCode == '' ? 'all' : $this->branchCode;

        session()->put('companyCode', $this->companyCode);
        session()->put('branchCode', $this->branchCode);
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
    }

    public function logout(): void
    {
        auth()->logout();
        redirect('/');
    }

    public function render(): View
    {
        return view('livewire.dashboard-top-bar', [
            'companies' => Company::all(),
            'branches' => $this->company?->branches,
        ]);
    }
}