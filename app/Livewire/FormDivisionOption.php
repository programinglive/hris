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

    public $option = "disabled";

    /**
     * Update the division ID and dispatch the 'setDivision' event with the new ID.
     *
     * @param string $divisionCode The new division ID.
     * @return void
     */
    public function updatedDivisionId(string $divisionCode): void
    {
        $this->dispatch('setDivision',  divisionCode: $divisionCode );
    }

    #[On('getDivision')]
    public function getDivision($departmentCode): void
    {
        $this->reset([
           'divisions',
           'option'
        ]);

        $department = Department::where('code', $departmentCode)->first();

        if($department == null) {
            return;
        }

        $divisions = Division::where('department_id', $department->id);

        if($divisions->count() > 0) {
            $this->option = "";
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