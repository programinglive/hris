<?php

namespace App\Livewire;

use App\Models\Division;
use Illuminate\Contracts\View\View;
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

    public $divisions;

    #[Url(keep: true)]
    public $divisionCode;

    public function mount(): void
    {
        if ($this->companyCode != '' && $this->branchCode != '' && $this->departmentCode != '') {
            $this->divisions = Division::where('company_code', $this->companyCode)
                ->where('branch_code', $this->branchCode)
                ->where('department_code', $this->departmentCode)
                ->get();
        }
    }

    /**
     * Update the division ID and dispatch the 'setDivision' event with the new ID.
     *
     * @param  string  $divisionCode  The new division ID.
     */
    public function updatedDivisionCode(string $divisionCode): void
    {
        $this->resetErrorBag();

        $this->dispatch('set-division', $divisionCode);
        $this->dispatch('get-level', $divisionCode);
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

    /**
     * Retrieves the division based on the provided department code and updates the corresponding properties.
     *
     * @param  string  $departmentCode  The code of the department.
     */
    #[On('get-division')]
    public function getDivision(string $departmentCode): void
    {
        $this->reset([
            'divisions',
        ]);

        $this->divisions = Division::where('department_code', $departmentCode)->get();
    }

    #[On('clear-division-option')]
    public function clearDivisionOption(): void
    {
        $this->reset([
            'divisionCode',
        ]);
    }

    /**
     * Render the view for the form division option.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.form-division-option');
    }
}
