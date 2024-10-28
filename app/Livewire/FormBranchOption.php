<?php

namespace App\Livewire;

use App\Models\Branch;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class FormBranchOption extends Component
{
    #[Url(keep: true)]
    public $companyCode;

    #[Url(keep: true)]
    public $branchCode;

    public $branches;

    /**
     * Mount the component
     */
    public function mount(): void
    {
        if ($this->companyCode != '') {
            $this->branches = Branch::where(
                'company_code', $this->companyCode
            )->get();
        }

        $branch = Branch::where('code', $this->branchCode)->first();

        if (! $branch) {
            $this->dispatch('clear-branch-option');
            $this->dispatch('clear-department-option');
        }
    }

    /**
     * When the branch code is updated, set the branch code to the event dispatcher.
     */
    public function updatedBranchCode(string $branchCode): void
    {
        $this->dispatch('clear-department-option');

        $this->dispatch('set-branch', $branchCode);
        $this->dispatch('get-department', $this->companyCode, $this->branchCode);
    }

    /**
     * Set the company code
     *
     * @param  string  $companyCode  the new value for the company code
     */
    #[On('set-company')]
    public function setCompany(string $companyCode): void
    {
        $this->companyCode = $companyCode;

        $this->dispatch('get-branch', $this->companyCode);
    }

    /**
     * Set the branch code
     *
     * @param  string  $branchCode  the new value for the branch code
     */
    #[On('set-branch')]
    public function setBranch(string $branchCode): void
    {
        $this->branchCode = $branchCode;

        $this->dispatch('get-department', $this->companyCode, $this->branchCode);
    }

    #[On('get-branch')]
    /**
     * Get the branch data.
     */
    public function getBranch(string $companyCode): void
    {
        $this->branches = Branch::where(
            'company_code', $companyCode
        )->get();
    }

    /**
     * Clear the branch option and reset the error bag.
     */
    #[On('clear-branch-option')]
    public function clearBranchOption(): void
    {
        $this->reset([
            'branchCode',
        ]);

        $this->resetErrorBag();
        $this->dispatch('clear-department-option');
    }

    /**
     * Render the view for the Livewire component.
     */
    public function render(): View
    {
        return view('livewire.form-branch-option');
    }
}