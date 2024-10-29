<?php

namespace App\Livewire;

use App\Models\SubDivision;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class FormSubDivisionOption extends Component
{
    #[Url(keep: true)]
    public $companyCode;

    #[Url(keep: true)]
    public $branchCode;

    #[Url(keep: true)]
    public $departmentCode;

    #[Url(keep: true)]
    public $subDivisionCode;

    /**
     * Update the division ID and dispatch the 'setSubDivision' event with the new ID.
     *
     * @param  string  $subDivisionCode  The new division ID.
     */
    public function updatedSubDivisionCode(string $subDivisionCode): void
    {
        $this->resetErrorBag();

        $this->dispatch('set-sub-division', $subDivisionCode);
        $this->dispatch('get-level', $subDivisionCode);
    }

    /**
     * Set the division code.
     *
     * @param  string  $subDivisionCode  The division code.
     */
    #[On('set-sub-division')]
    public function setSubDivision(string $subDivisionCode): void
    {
        $this->subDivisionCode = $subDivisionCode;
    }

    /**
     * Retrieves the division based on the provided department code and updates the corresponding properties.
     */
    public function getSubDivision(): Collection
    {
        return SubDivision::all();
    }

    #[On('clear-form')]
    public function clearForm(): void
    {
        $this->reset();
        $this->resetErrorBag();
    }

    /**
     * Render the view for the form division option.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.form-sub-division-option',[
            'subDivisions' => self::getSubDivision()
        ]);
    }
}