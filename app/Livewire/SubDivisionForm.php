<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\SubDivision;
use DB;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SubDivisionForm extends Component
{
    public $departmentId;

    #[Validate('required|unique:sub_divisions|min:3')]
    public $code;

    #[Validate('required|min:3')]
    public $name;

    public $subDivision;

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
    public function subDivisionData(): array
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
     * Saves the subDivision details to the database and dispatches a 'sub-division-created' event.
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
            $this->subDivision = SubDivision::create($this->subDivisionData());
        }, 5);

        $this->dispatch('sub-division-created', subDivisionId: $this->subDivision->id);

        $this->reset();
    }

    /**
     * Edit the subDivision details.
     */
    #[On('edit')]
    public function edit($code): void
    {
        $this->subDivision = SubDivision::where('code',$code)->first();
        $this->departmentId = $this->subDivision->department_id;

        $this->dispatch('selectDepartment', departmentId: $this->departmentId );

        $this->code = $this->subDivision->code;
        $this->name = $this->subDivision->name;

        $this->actionForm = 'update';

        $this->dispatch('show-form');
    }

    /**
     * Updates the subDivision details in the database.
     */
    public function update(): void
    {
        if(!$this->departmentId){
            $this->dispatch('setErrorDepartment');
            return;
        }

        DB::transaction(function () {
            $this->subDivision->update($this->subDivisionData());
        }, 5);

        $this->dispatch('sub-division-updated', subDivisionId: $this->subDivision->id);

        $this->reset();
    }

    /**
     * Deletes the subDivision from the database.
     */
    #[On('delete')]
    public function destroy($code): void
    {
        $this->subDivision = SubDivision::where('code',$code)->first();
        $this->subDivision->code = $code . '-deleted';
        $this->subDivision->save();

        $this->subDivision->delete();

        $this->dispatch('sub-division-deleted', refreshCompanies: true);
    }

    /**
     * Render the livewire component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.sub-division-form', [
            'departments' => Department::all(),
        ]);
    }
}