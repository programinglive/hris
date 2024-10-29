<?php

namespace App\Livewire;

use App\Models\Department;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class FormDepartmentOption extends Component
{
    #[Url(keep: true)]
    public $departmentCode;

    /**
     * Update the department ID and dispatch the 'setDepartment' event with the new ID.
     *
     * @param  string  $departmentCode  The new department ID.
     */
    public function updatedDepartmentCode(string $departmentCode): void
    {
        $this->dispatch('set-department', $departmentCode);
    }

    #[On('set-department')]
    public function setDepartment($departmentCode): void
    {
        $this->departmentCode = $departmentCode;
    }

    /**
     * Get all departments.
     *
     * @return Collection<Department>
     */
    public function getDepartment(): Collection
    {
        return Department::all();
    }

    #[On('clear-form')]
    public function clearForm(): void
    {
        $this->reset();
        $this->resetErrorBag();
    }

    /**
     * Render the view for the form department option.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.form-department-option', [
            'departments' => self::getDepartment(),
        ]);
    }
}
