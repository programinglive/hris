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

    /**
     * Handle updated company code.
     */
    public function updatedCompanyCode(string $companyCode): void
    {
        $this->dispatch('set-company', $companyCode);
    }

    #[On('set-company')]
    public function setCompany($companyCode): void
    {
        $this->companyCode = $companyCode;
    }

    /**
     * Get company data.
     *
     * @return Collection
     */
    public function getCompanyData(): Collection
    {
        return Company::all();
    }

    #[On('clear-form')]
    public function clearForm(): void
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