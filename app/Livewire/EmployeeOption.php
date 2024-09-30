<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class EmployeeOption extends Component
{
    public $search;

    public $employees;

    public $employee;

    public $employeeDetail;

    public function updated(): void
    {
        $this->employees = User::where(
            'name', 'like', '%'.$this->search.'%'
        )->get();
    }

    public function selectEmployee($employeeId): void
    {
        $this->employee = User::find($employeeId);
        $this->employeeDetail = $this->employee->details->toArray();

        $this->employee = $this->employee->toArray();

        $this->employee = array_merge($this->employee, $this->employeeDetail);

        $this->dispatch('set-employee', employee: $this->employee);

        $this->search = $this->employee['name'];

        $this->employees = null;
    }

    public function render(): View
    {
        return view('livewire.employee-option');
    }
}
