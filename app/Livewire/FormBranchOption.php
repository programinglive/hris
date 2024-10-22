<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Company;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class FormBranchOption extends Component
{
    public $companyId;

    public $company;

    #[Url(keep: true)]
    public $companyCode;

    public $branch;

    #[Url(keep: true)]
    public $branchCode;

    public $branches;

    /**
     * Reset the component state.
     */
    public function mount(): void
    {
        if ($this->companyCode != 'all' || $this->companyCode != '') {
            $company = Company::where('code', $this->companyCode)->first();

            if ($company) {
                $this->companyId = $company->id;
                $this->branches = $company->branches;
            }
        }

        if ($this->branchCode) {
            $this->setBranch($this->branchCode);
        }
    }

    /**
     * When the branch code is updated, set the branch code to the event dispatcher.
     */
    public function updatedBranchCode(string $branchCode): void
    {
        $this->dispatch('set-branch', $branchCode);
    }

    /**
     * Set the company based on the company code
     */
    #[On('setCompany')]
    public function setCompany(string $companyCode): void
    {
        $this->companyCode = $companyCode;

        if ($companyCode != 'all') {
            $this->company = Company::where('code', $companyCode)->first();
            $this->companyId = $this->company->id;

            $this->branches = $this->company->branches;
        }
    }

    /**
     * Set the branch ID for the details.
     */
    #[On('set-branch')]
    public function setBranch(string $branchCode): void
    {
        $this->branchCode = $branchCode;

        if ($branchCode != 'all') {
            $this->branch = Branch::where('code', $branchCode)->first();
        }
    }

    /**
     * Render the view for the Livewire component.
     */
    public function render(): View
    {
        return view('livewire.form-branch-option');
    }
}
