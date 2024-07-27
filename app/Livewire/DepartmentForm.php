<?php

namespace App\Livewire;

use App\Models\Department;
use DB;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class DepartmentForm extends Component
{
    #[Validate('required|unique:departments|min:3')]
    public $code;

    #[Validate('required|unique:departments|min:3')]
    public $name;

    public $department;

    public $actionForm = 'save';

    /**
     * Updates the specified property with the given value and performs validation if the property is 'code',
     * 'email', or 'phone'.
     *
     * @param string $key The name of the property to be updated.
     * @param mixed $value The new value for the property.
     * @return void
     * @throws ValidationException
     */
    public function updated(string $key, mixed $value): void
    {
        if($key == 'code' || $key == 'name'){
            $this->validateOnly($key);
        }
    }

    /**
     * The default data for the form.
     *
     * @return array
     */
    public function departmentData(): array
    {
        return [
            'company_id' => auth()->user()->details->company_id,
            'branch_id' => auth()->user()->details->branch_id,
            'code' => $this->code,
            'name' => $this->name,
        ];
    }

    /**
     * Saves the department details to the database and dispatches a 'department-created' event.
     *
     * @return void
     */
    public function save(): void
    {
        $this->validate();

        DB::transaction(function () {
            $this->department = Department::create($this->departmentData());
        }, 5);

        $this->dispatch('department-created', departmentId: $this->department->id);

        $this->reset();
    }

    /**
     * Edit the department details.
     */
    #[On('edit')]
    public function edit($code): void
    {
        $this->department = Department::where('code',$code)->first();
        $this->code = $this->department->code;
        $this->name = $this->department->name;

        $this->actionForm = 'update';

        $this->dispatch('show-form');
    }

    /**
     * Updates the department details in the database.
     */
    public function update(): void
    {
        DB::transaction(function () {
            $this->department->update($this->departmentData());
        }, 5);

        $this->dispatch('department-updated', departmentId: $this->department->id);

        $this->reset();
    }

    /**
     * Deletes the department from the database.
     */
    #[On('delete')]
    public function destroy($code): void
    {
        $this->department = Department::where('code',$code)->first();
        $this->department->delete();

        $this->dispatch('department-deleted', refreshCompanies: true);
    }

    /**
     * Render the livewire component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.department-form');
    }
}