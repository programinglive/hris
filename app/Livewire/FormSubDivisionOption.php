<?php

namespace App\Livewire;

use App\Models\SubDivision;
use Illuminate\Contracts\View\View;
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

    public $subDivisions;

    #[Url(keep: true)]
    public $subDivisionCode;

    public function mount(): void
    {
        if ($this->companyCode != '' && $this->branchCode != '' && $this->departmentCode != '') {
            $this->subDivisions = SubDivision::where('company_code', $this->companyCode)
                ->where('branch_code', $this->branchCode)
                ->where('department_code', $this->departmentCode)
                ->get();
        }
    }

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
     *
     * @param  string  $departmentCode  The code of the department.
     */
    #[On('get-division')]
    public function getSubDivision(string $departmentCode): void
    {
        $this->reset([
            'subDivisions',
        ]);

        $this->subDivisions = SubDivision::where(
            'department_code',
            $departmentCode
        )->get();
    }

    #[On('clear-division-option')]
    public function clearSubDivisionOption(): void
    {
        $this->reset([
            'subDivisionCode',
        ]);
    }

    /**
     * Render the view for the form division option.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.form-sub-division-option');
    }
}
