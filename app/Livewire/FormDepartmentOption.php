<?php

namespace App\Livewire;

use App\Models\Company;
use App\Models\Department;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class FormDepartmentOption extends Component
{
    public $departmentCode;

    public $companyId;

    #[Url(keep: true)]
    public $companyCode;

    public $option = 'disabled';

    public $departments;

    /**
     * Mount the component and retrieve departments if the company code is not "all".
     */
    public function mount(): void
    {
        if ($this->companyCode != 'all') {
            $company = Company::where('code', $this->companyCode)->first();

            if ($company) {
                $this->option = '';
                $this->companyId = $company->id;
                $this->departments = $company->departments;
            }
        }
    }

    /**
     * Update the option value based on the provided option.
     *
     * @param  mixed  $option  The new option value.
     */
    #[On('departmentOption')]
    public function departmentOption(mixed $option): void
    {
        $this->option = $option;
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

    /**
     * Update the department ID based on the provided department ID.
     *
     * @param  int  $departmentCode  The ID of the department.
     */
    #[On('selectDepartment')]
    public function selectDepartment(int $departmentCode): void
    {
        $this->departmentCode = Department::where('code', $departmentCode)->id;
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
     */
    #[On('getDepartment')]
    public function getDepartment(string $companyCode): void
    {
        $this->reset([
            'departments',
            'option',
        ]);

        $company = Company::where('code', $companyCode)->first();

        if (! $company) {
            $this->option = 'disabled';

            return;
        }

        if ($company->departments()->count() > 0) {
            $this->option = '';
            $this->departments = $company->departments;
        }
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