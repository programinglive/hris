<?php

namespace App\Livewire;

use App\Models\User;
use DB;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EmployeeForm extends Component
{
    #[Validate('required|unique:employees|min:3')]
    public $code;

    #[Validate('required|unique:employees|min:3')]
    public $name;

    public $employee;

    public $actionForm = 'save';

    /**
     * Updates the specified property with the given value and performs validation if the property is 'code',
     * 'email', or 'phone'.
     *
     * @param  string  $key  The name of the property to be updated.
     * @param  mixed  $value  The new value for the property.
     *
     * @throws ValidationException
     */
    public function updated(string $key, mixed $value): void
    {
        if ($key == 'code' || $key == 'name') {
            $this->validateOnly($key);
        }
    }

    /**
     * The default data for the form.
     */
    public function employeeData(): array
    {
        return [
            'company_id' => auth()->user()->details->company_id,
            'branch_id' => auth()->user()->details->branch_id,
            'code' => $this->code,
            'name' => strtolower(trim($this->name)),
        ];
    }

    /**
     * Saves the employee details to the database and dispatches a 'employee-created' event.
     */
    public function save(): void
    {
        $this->validate();

        DB::transaction(function () {
            $this->employee = User::create($this->employeeData());
        }, 5);

        $this->dispatch('employee-created', employeeId: $this->employee->id);

        $this->reset();
    }

    /**
     * Edit the employee details.
     */
    #[On('edit')]
    public function edit($code): void
    {
        $this->employee = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('user_details.code', $code)->first();
        $this->code = $this->employee->details?->code;
        $this->name = $this->employee->name;

        $this->actionForm = 'update';

        $this->dispatch('show-form');
    }

    /**
     * Updates the employee details in the database.
     */
    public function update(): void
    {
        DB::transaction(function () {
            $this->employee->update($this->employeeData());
        }, 5);

        $this->dispatch('employee-updated', employeeId: $this->employee->id);

        $this->reset();
    }

    /**
     * Deletes the employee from the database.
     */
    #[On('delete')]
    public function destroy($code): void
    {
        $this->employee = User::where('code', $code)->first();
        $this->employee->delete();

        $this->dispatch('employee-deleted', refreshCompanies: true);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.employee-form');
    }
}
