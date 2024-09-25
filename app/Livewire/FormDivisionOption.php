<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Division;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class FormDivisionOption extends Component
{
    public $divisionCode;

    public $divisions;

    public $option = 'disabled';

    /**
     * Update the division ID and dispatch the 'setDivision' event with the new ID.
     *
     * @param  string  $divisionCode  The new division ID.
     */
    public function updatedDivisionCode(string $divisionCode): void
    {
        $this->resetErrorBag();

        $this->dispatch('setDivision', divisionCode: $divisionCode);
        $this->dispatch('getLevel', divisionCode: $divisionCode);
    }

    /**
     * Retrieves the division based on the provided department code and updates the corresponding properties.
     *
     * @param  string  $departmentCode  The code of the department.
     */
    #[On('getDivision')]
    public function getDivision(string $departmentCode): void
    {
        $this->reset([
            'divisions',
            'option',
        ]);

        $department = Department::where('code', $departmentCode)->first();

        if ($department == null) {
            return;
        }

        $divisions = Division::where('department_id', $department->id);

        if ($divisions->count() > 0) {
            $this->option = '';
            $this->divisions = $divisions->get();
        }
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
