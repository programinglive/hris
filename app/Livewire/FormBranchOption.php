<?php

namespace App\Livewire;

use App\Models\Company;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class FormBranchOption extends Component
{
    public $companyId;

    #[Url(keep: true)]
    public $companyCode = 'all';

    public $branchCode;

    public $option = 'disabled';

    public $branches;

    public function mount(): void
    {
        $this->reset();

        if ($this->companyCode != 'all') {
            $company = Company::where('code', $this->companyCode)->first();

            if ($company) {
                $this->option = '';
                $this->companyId = $company->id;
                $this->branches = $company->branches;
            }
        }
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
