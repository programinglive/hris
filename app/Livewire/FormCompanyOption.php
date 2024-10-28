<?php

namespace App\Livewire;

use App\Models\Company;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class FormCompanyOption extends Component
{
    #[Url(keep: true)]
    public $companyCode;

    #[Url(keep: true)]
    public $branchCode;

    /**
     * Mount the component
     */
    public function mount(): void
    {
        $company = Company::where('code', $this->companyCode)->first();

        if (! $company) {
            $this->dispatch('clear-company-option');
            $this->dispatch('clear-branch-option');
        }
    }

    /**
     * Updates the company ID and emits a 'setCompany' event.
     *
     * @param  mixed  $companyCode  The new value for the company ID.
     */
    public function updatedCompanyCode(mixed $companyCode): void
    {
        $this->resetErrorBag();

        $this->dispatch('set-company', $companyCode);
        $this->dispatch('get-branch', $companyCode);

        if ($this->companyCode == '') {
            $this->reset('branchCode');
            $this->dispatch('clear-branch-option');
        }
    }

    /**
     * Set the company based on the company code.
     *
     * @param  string  $companyCode  The code of the company.
     */
    #[On('set-company')]
    public function setCompany(string $companyCode): void
    {
        $this->companyCode = $companyCode;
    }

    /**
     * Handles the 'companyRequired' event by adding an error message to the 'companyId' field.
     */
    #[On('companyRequired')]
    public function companyRequired(): void
    {
        $this->addError('companyCode', 'This field is required');
    }

    /**
     * Retrieves the company data based on the value of `$companyCode`.
     *
     * @return Collection The collection of company data if `$companyCode` is empty,
     *                    otherwise an empty collection.
     */
    public function getCompanyData(): Collection
    {
        return Company::all();
    }

    /**
     * Clears the form by resetting all properties and error bag.
     */
    #[On('clear-company-option')]
    public function clearCompanyOption(): void
    {
        $this->reset();
        $this->resetErrorBag();
    }

    #[On('refresh')]
    public function refresh(): void {}

    /**
     * Render the view for the form company option.
     */
    public function render(): View
    {
        return view('livewire.form-company-option', [
            'companies' => self::getCompanyData(),
        ]);
    }
}
