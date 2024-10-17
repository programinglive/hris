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

    public $option = 'disabled';

    public $branches;

    /**
     * Reset the component state.
     */
    public function mount(): void
    {
        if ($this->companyCode != 'all') {
            $company = Company::where('code', $this->companyCode)->first();

            if ($company) {
                $this->companyId = $company->id;
                $this->branches = $company->branches;

            }
        }

        if ($this->branchCode != 'all') {
            $this->setBranch($this->branchCode);
        }
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
        $this->dispatch('refreshBranches');
        $this->companyCode = $companyCode;

        if ($companyCode != 'all') {
            $this->company = Company::where('code', $companyCode)->first();
            $this->companyId = $this->company->id;

            $this->branches = $this->company->branches;
        }
    }

    /**
     * Set the branch ID for the details.
     *
     * @param string $branchCode
     */
    #[On('setBranch')]
    public function setBranch(string $branchCode): void
    {
        $this->branchCode = $branchCode;

        if ($branchCode != 'all') {
            $this->branch = Branch::where('code', $branchCode)->first();
            $this->dispatch('setBranchId', $this->branch->id);
            $this->option = '';
        }
    }

    /**
     * When the branch code is updated, set the branch code to the event dispatcher.
     *
     * @param string $branchCode
     * @return void
     */
    public function updatedBranchCode(string $branchCode): void
    {
        $this->dispatch('setBranch', $branchCode);
    }

    /**
     * Retrieves the branch information for a given company code.
     *
     * @param  string  $companyCode  The code of the company.
     */
    #[On('getBranch')]
    public function getBranch(string $companyCode): void
    {
        $this->reset([
            'branches',
            'option',
        ]);

        $company = Company::where('code', $companyCode)->first();

        if (! $company) {
            $this->option = 'disabled';

            return;
        }

        $this->option = '';
        $this->companyId = $company->id;

        if ($company->branches()->count() > 0) {
            $this->option = '';
            $this->branches = $company->branches;
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