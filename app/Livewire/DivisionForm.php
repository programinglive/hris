<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Division;
use DB;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class DivisionForm extends Component
{
    public $departmentId;

    #[Validate('required|unique:divisions|min:3')]
    public $code;

    #[Validate('required|min:3')]
    public $name;

    public $division;

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
        $this->resetErrorBag();

        if($key == 'code' || $key == 'name'){
            $this->validateOnly($key);
        }
    }

    /**
     * Sets the department ID based on the provided department code.
     *
     * @param string $departmentCode The code of the department.
     * @return void
     */
    #[On('setDepartment')]
    public function setDepartment(string $departmentCode): void
    {
        $department = Department::where('code', $departmentCode)->first();

        if(!$department){
            $this->dispatch('setErrorDepartment');
            return;
        }

        $this->departmentId = $department->id;
    }

    /**
     * The default data for the form.
     *
     * @return array
     */
    public function divisionData(): array
    {
        return [
            'company_id' => auth()->user()->details->company_id,
            'branch_id' => auth()->user()->details->branch_id,
            'department_id' => $this->departmentId,
            'code' => $this->code,
            'name' => $this->name,
        ];
    }

    /**
     * Saves the division details to the database and dispatches a 'division-created' event.
     *
     * @return void
     */
    public function save(): void
    {
        if(!$this->departmentId){
            $this->dispatch('setErrorDepartment');
            return;
        }
        
        $this->validate();

        DB::transaction(function () {
            $this->division = Division::create($this->divisionData());
        }, 5);

        $this->dispatch('division-created', divisionId: $this->division->id);

        $this->reset();
    }

    /**
     * Edit the division details.
     */
    #[On('edit')]
    public function edit($code): void
    {
        $this->division = Division::where('code',$code)->first();
        $this->departmentId = $this->division->department_id;

        $this->dispatch('selectDepartment', departmentId: $this->departmentId );

        $this->code = $this->division->code;
        $this->name = $this->division->name;

        $this->actionForm = 'update';

        $this->dispatch('show-form');
    }

    /**
     * Updates the division details in the database.
     */
    public function update(): void
    {
        if(!$this->departmentId){
            $this->dispatch('setErrorDepartment');
            return;
        }
        
        DB::transaction(function () {
            $this->division->update($this->divisionData());
        }, 5);

        $this->dispatch('division-updated', divisionId: $this->division->id);

        $this->reset();
    }

    /**
     * Deletes the division from the database.
     */
    #[On('delete')]
    public function destroy($code): void
    {
        $this->division = Division::where('code',$code)->first();
        $this->division->code = $code . '-deleted';
        $this->division->save();

        $this->division->delete();

        $this->dispatch('division-deleted', refreshCompanies: true);
    }

    /**
     * Render the livewire component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.division-form', [
            'departments' => Department::all(),
        ]);
    }
}