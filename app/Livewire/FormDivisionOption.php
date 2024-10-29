<?php

namespace App\Livewire;

use App\Models\Division;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class FormDivisionOption extends Component
{
    #[Url(keep: true)]
    public $companyCode;

    #[Url(keep: true)]
    public $branchCode;

    #[Url(keep: true)]
    public $departmentCode;

    #[Url(keep: true)]
    public $divisionCode;

    /**
     * Update the division ID and dispatch the 'setDivision' event with the new ID.
     *
     * @param  string  $divisionCode  The new division ID.
     */
    public function updatedDivisionCode(string $divisionCode): void
    {
        $this->dispatch('set-division', $divisionCode);
    }

    /**
     * Set the division code.
     *
     * @param  string  $divisionCode  The division code.
     */
    #[On('set-division')]
    public function setDivision(string $divisionCode): void
    {
        $this->divisionCode = $divisionCode;
    }

    public function getDivision(): Collection
    {
        return Division::all();
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
        return view('livewire.form-division-option', [
            'divisions' => self::getDivision(),
        ]);
    }
}
