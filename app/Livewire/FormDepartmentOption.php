<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class FormDepartmentOption extends Component
{
    public $department;

    public $departmentCode;

    public $company;

    public $companyId;

    #[Url(keep: true)]
    public $companyCode;

    public $branch;

    public $branchId;

    #[Url(keep: true)]
    public $branchCode;

    public $departments;

    /**
     * Mount the component and retrieve departments if the company code is not "all".
     */
    public function mount(): void
    {
        if ($this->companyCode != 'all') {
            $company = Company::where('code', $this->companyCode)->first();

            if ($company) {
                $this->companyId = $company->id;

                $this->branch = Branch::where('code', $this->branchCode)->first();

                if ($this->branch) {
                    $this->branchId = $this->branch->id;
                    $this->departments = Department::where('company_id', $this->companyId)
                        ->where('branch_id', $this->branchId)->get();
                }
            }
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

        $this->dispatch('setDepartment', departmentCode: $departmentCode);
        $this->dispatch('getDivision', departmentCode: $departmentCode);

    }

    #[On('set-department')]
    public function setDepartment($departmentCode): void
    {
        $this->department = Department::where('code', $departmentCode)->first();
        $this->departmentCode = $departmentCode;
    }

    #[On('clear-department')]
    public function clearDepartment(): void
    {
        $this->reset(['departments', 'departmentCode']);
    }

    /**
     * Dispatch the 'setErrorDepartment' event.
     */
    #[On('setErrorDepartment')]
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
