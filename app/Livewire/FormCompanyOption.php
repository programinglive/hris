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
    public $company;

    public $companyId;

    #[Url(keep: true)]
    public $companyCode;

    public $companyName;

    /**
     * Updates the company ID and emits a 'setCompany' event.
     *
     * @param  mixed  $companyCode  The new value for the company ID.
     */
    public function updatedCompanyCode(mixed $companyCode): void
    {
        $this->resetErrorBag();

        if ($companyCode == '') {
            $this->addError('companyCode', 'This field is required');
            $this->dispatch('clear-company');
            $this->companyCode = 'all';

            return;
        }

        $this->companyCode = $companyCode;
        $this->dispatch('set-company', $companyCode);
        $this->dispatch('getBranch', $companyCode);
        $this->dispatch('getDepartment', $companyCode);
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

        if ($companyCode != 'all') {
            $this->company = Company::where('code', $companyCode)->first();
            $this->companyId = $this->company->id;
        }

        $this->dispatch('refreshBranches');
    }

    /**
     * Resets the 'companyCode' property to its initial value.
     */
    #[On('refreshCompany')]
    public function refreshCompany(): void
    {
        $this->companyCode = 'all';
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
    #[On('clear-form')]
    public function clearForm(): void
    {
        $this->reset();
        $this->resetErrorBag();
    }

    #[On('refresh')]
    public function refresh(): void
    {
        $this->resetPage();
    }

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