<?php

namespace App\Livewire;

use App\Models\Company;
use App\Models\Department;
use DB;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

class DepartmentForm extends Component
{
    public $companyId;
    #[Url(keep:true)]
    public $companyCode = "all";

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
     * Sets the value of the companyCode property to the given code.
     *
     * @param string $code The code to set the companyCode property to.
     * @return void
     */
    #[On('setCompanyCode')]
    public function setCompanyCode(string $code): void
    {
        if($code == ""){
            abort(404);
        }

        if($code !== 'all'){
            $this->companyCode = $code;

            $this->companyId = Company::where('code', $code)->first()->id;
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
            'company_id' => $this->companyId,
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

        $this->companyId = $this->department->company_id;
        $this->dispatch('selectCompany', $this->companyId);

        $this->actionForm = 'update';

        $this->dispatch('disableFilter');
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

        $this->dispatch('enableFilter');

        $this->reset();
    }

    /**
     * Deletes the department from the database.
     */
    #[On('delete')]
    public function destroy($code): void
    {
        $this->department = Department::where('code',$code)->first();
        $this->department->code = $this->department->code.'-deleted';
        $this->department->save();

        $this->department->delete();

        $this->reset();

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