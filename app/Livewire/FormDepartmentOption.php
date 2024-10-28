<?php

namespace App\Livewire;

use App\Models\Department;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class FormDepartmentOption extends Component
{
    #[Url(keep: true)]
    public $companyCode;

    #[Url(keep: true)]
    public $branchCode;

    public $departments;

    public $department;

    #[Url(keep: true)]
    public $departmentCode;

    /**
     * Mount the component
     */
    public function mount(): void
    {
        if ($this->companyCode != '' && $this->branchCode != '') {
            $this->departments = Department::where('company_code', $this->companyCode)
                ->where('branch_code', $this->branchCode)
                ->get();
        }
    }

    /**
     * Update the department ID and dispatch the 'setDepartment' event with the new ID.
     *
     * @param  string  $departmentCode  The new department ID.
     */
    public function updatedDepartmentCode(string $departmentCode): void
    {
        $this->resetErrorBag();

        $this->dispatch('set-department', $departmentCode);
        $this->dispatch('get-division', $departmentCode);
    }

    #[On('set-department')]
    public function setDepartment($departmentCode): void
    {
        $this->department = Department::where('code', $departmentCode)->first();
        $this->departmentCode = $departmentCode;

        $this->dispatch('get-division', $departmentCode);
    }

    /**
     * Dispatch the 'set-error-department' event.
     */
    #[On('set-error-department')]
    public function setErrorDepartment(): void
    {
        $this->addError('departmentCode', 'Please select department');
    }

    /**
     * Get the departments based on the provided company code.
     *
     * @param  string  $companyCode  The company code.
     * @param  string  $branchCode  The branch code.
     */
    #[On('get-department')]
    public function getDepartment(string $companyCode, string $branchCode): void
    {
        $this->reset([
            'departments',
        ]);

        $this->departments = Department::where('company_code', $companyCode)
            ->where('branch_code', $branchCode)
            ->get();
    }

    #[On('clear-department-option')]
    public function clearDepartmentOption(): void
    {
        $this->reset([
            'departmentCode',
        ]);
    }

    /**
     * Render the view for the form department option.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.form-department-option');
    }
}
