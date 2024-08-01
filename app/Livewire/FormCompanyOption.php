<?php

namespace App\Livewire;

use App\Models\Company;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class FormCompanyOption extends Component
{
    public $companyId;
    #[Url(keep:true)]
    public $companyCode = "";

    /**
     * Handles the 'companyRequired' event by adding an error message to the 'companyId' field.
     *
     * @return void
     */
    #[On('companyRequired')]
    public function companyRequired(): void
    {
        $this->addError('companyId', 'This field is required');
    }

    /**
     * Updates the company ID and emits a 'setCompanyCode' event.
     *
     * @param mixed $value The new value for the company ID.
     * @return void
     */
    public function updatedCompanyId(mixed $value): void
    {
        if($value == "") {
            $this->addError('companyCode', 'This field is required');
            return;
        }

        $this->companyCode = $value;

        $this->emit('setCompanyCode', $value);
    }

    /**
     * Retrieves the company data based on the value of `$companyCode`.
     *
     * @return Collection The collection of company data if `$companyCode` is empty,
     *                                        otherwise an empty collection.
     */
    public function getCompanyData(): Collection
    {
        if(auth()->user()->details->role == 'administrator') {
            return Company::all();
        }
        return collect();
    }
    /**
     * Render the view for the form company option.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.form-company-option', [
            'companies' => self::getCompanyData(),
        ]);
    }
}