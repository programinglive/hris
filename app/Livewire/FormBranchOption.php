<?php

namespace App\Livewire;

use App\Models\Branch;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class FormBranchOption extends Component
{
    #[Url(keep: true)]
    public $companyCode;

    #[Url(keep: true)]
    public $branchCode;

    /**
     * When the branch code is updated, set the branch code to the event dispatcher.
     */
    public function updatedBranchCode(string $branchCode): void
    {
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
    }

    /**
     * Get the branch data.
     */
    #[On('get-branch')]
    public function getBranch(): Collection
    {
        return Branch::all();
    }

    #[On('clear-form')]
    public function clearForm(): void
    {
        $this->reset();
        $this->resetErrorBag();
    }

    /**
     * Render the view for the Livewire component.
     */
    public function render(): View
    {
        return view('livewire.form-branch-option', [
            'branches' => $this->getBranch(),
        ]);
    }
}
