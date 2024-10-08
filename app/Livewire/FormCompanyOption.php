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
    public $companyCode = 'all';

    public $companyName = 'all';

    /**
     * Initializes the component by dispatching a 'refreshCompany' event.
     */
    public function mount(): void
    {
        $this->companyCode = session('companyCode');
    }

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
            $this->dispatch('resetCompanyId');
            $this->companyCode = 'all';

            return;
        }

        $this->companyCode = $companyCode;

        $this->dispatch('setCompany', $companyCode);
        $this->dispatch('getBranch', $companyCode);
        $this->dispatch('getDepartment', $companyCode);

        session(['companyCode' => $companyCode]);
    }

    #[On('setCompany')]
    public function setCompany($companyCode): void
    {
        $this->companyCode = $companyCode;
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
     * Selects the company with the given ID and emits a 'selectCompany' event.
     *
     * @param  string  $companyCode  The ID of the company to select.
     */
    #[On('selectCompany')]
    public function selectCompany(string $companyCode): void
    {
        $this->company = Company::where('code', $companyCode)->first();
        $this->companyId = $this->company->id;
        $this->companyCode = $companyCode;
        $this->companyName = $this->company->name;
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
    #[On('clearFormCompanyOption')]
    public function clearFormCompanyOption(): void
    {
        $this->reset();
        $this->resetErrorBag();
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
