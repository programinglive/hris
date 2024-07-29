<?php

namespace App\Livewire;

use App\Models\Department;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class FormDepartmentOption extends Component
{
    public $departmentId;

    /**
     * Update the department ID and dispatch the 'setDepartment' event with the new ID.
     *
     * @param string $departmentCode The new department ID.
     * @return void
     */
    public function updatedDepartmentId(string $departmentCode): void
    {
        $this->dispatch('setDepartment',  departmentCode: $departmentCode );
    }

    /**
     * Update the department ID based on the provided department ID.
     *
     * @param int $departmentId The ID of the department.
     * @return void
     */
    #[On('selectDepartment')]
    public function selectDepartment(int $departmentId): void
    {
        $this->departmentId =  Department::find($departmentId)->code;
    }

    /**
     * Dispatch the 'setErrorDepartment' event.
     *
     * @return void
     */
    #[On('setErrorDepartment')]
    public function setErrorDepartment(): void
    {
        $this->addError('departmentId', 'Please select department');
    }

    /**
     * Render the view for the form department option.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.form-department-option',[
            'departments' => Department::all(),
        ]);
    }
}