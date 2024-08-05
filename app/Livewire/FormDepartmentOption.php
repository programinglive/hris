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
    public $departmentId;

    public $companyId;

    #[Url(keep:true)]
    public $companyCode = "all";

    public $option = "disabled";

    public $departments;

    public function mount(): void
    {
        if($this->companyCode != "all") {
            $company = Company::where('code', $this->companyCode)->first();
            
            if($company) {
                $this->option = "";
                $this->companyId = $company->id;
                $this->departments = $company->departments;
            }
        }
    }

    /**
     * Update the option value based on the provided option.
     *
     * @param mixed $option The new option value.
     * @return void
     */
    #[On('departmentOption')]
    public function departmentOption(mixed $option): void
    {
        $this->option = $option;
    }

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
     * Retrieves the department data based on the provided option.
     *
     */
    #[On('getDepartment')]
    public function getDepartment($value): void
    {
        $this->reset([
            'departments',
            'option'
        ]);
        $company = Company::where('code', $value)->first();
        $countDepartment = Department::where('company_id', $company->id)->count();
        if($countDepartment > 0){
            $this->option ="";
            $this->departments = Department::where('company_id', $company->id)->get();
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