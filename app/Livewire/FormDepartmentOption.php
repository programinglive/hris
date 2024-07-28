<?php

namespace App\Livewire;

use App\Models\Department;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class FormDepartmentOption extends Component
{
    public $departmentId;

    /**
     * Update the department ID and dispatch the 'setDepartment' event with the new ID.
     *
     * @param int $departmentId The new department ID.
     * @return void
     */
    public function updatedDepartmentId(int $departmentId): void
    {
        $this->dispatch('setDepartment',  departmentId: $departmentId );
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