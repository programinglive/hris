<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;
use App\Models\Division;
use App\Models\Level;
use App\Models\SubDivision;
use DB;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class LevelForm extends Component
{
    public $company;
    public $companyCode;

    public $branch;
    public $branchCode;

    public $department;
    public $departmentCode;

    public $division;
    public $divisionCode;

    public $subDivision;
    public $subDivisionCode;


    #[Validate('required')]
    public $code;

    #[Validate('required')]
    public $name;

    public $description;

    public $level;

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

    #[On('set-company')]
    public function setCompany($companyCode): void
    {
        $this->company = Company::where('code', $companyCode)->first();
        $this->companyCode = $companyCode;
    }

    #[On('set-branch')]
    public function setBranch($branchCode): void
    {
        $this->branch = Branch::where('code', $branchCode)->first();
        $this->branchCode = $branchCode;
    }

    #[On('set-department')]
    public function setDepartment($departmentCode): void
    {
        $this->department = Department::where('code', $departmentCode)->first();
        $this->departmentCode = $departmentCode;
    }

    #[On('set-division')]
    public function setDivision($divisionCode): void
    {
        $this->division = Division::where('code', $divisionCode)->first();
        $this->divisionCode = $divisionCode;
    }

    #[On('set-sub-division')]
    public function setSubDivision($subDivisionCode): void
    {
        $this->subDivision = SubDivision::where('code', $subDivisionCode)->first();
        $this->subDivisionCode = $subDivisionCode;
    }

    /**
     * The default data for the form.
     */
    public function levelData(): array
    {
        return [
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'department_id' => $this->department->id,
            'division_id' => $this->division->id,
            'sub_division_id' => $this->subDivision->id,
            'company_code' => $this->company->code,
            'company_name' => $this->company->name,
            'branch_code' => $this->branch->code,
            'branch_name' => $this->branch->name,
            'department_code' => $this->department->code,
            'department_name' => $this->department->name,
            'division_code' => $this->division->code,
            'division_name' => $this->division->name,
            'sub_division_code' => $this->subDivision->code,
            'sub_division_name' => $this->subDivision->name,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
        ];
    }

    /**
     * Saves the level details to the database and dispatches a 'level-created' event.
     */
    public function save(): void
    {
        $this->validate();

        DB::transaction(function () {
            Level::create($this->levelData());
        }, 5);

        $this->dispatch('refresh');
        $this->dispatch('hide-form');
    }

    /**
     * Edit the level details.
     */
    #[On('edit')]
    public function edit($code): void
    {
        $this->level = Level::where('code', $code)->first();

        $this->company = $this->level->company;
        $this->companyCode  = $this->company->code;
        $this->dispatch('set-company', $this->companyCode);

        $this->branch = $this->level->branch;
        $this->branchCode = $this->branch->code;
        $this->dispatch('set-branch', $this->branchCode);

        $this->department = $this->level->department;
        $this->departmentCode = $this->department->code;
        $this->dispatch('set-department', $this->departmentCode);

        $this->division = $this->level->division;
        $this->divisionCode = $this->division->code;
        $this->dispatch('set-division', $this->divisionCode);

        $this->subDivision = $this->level->subDivision;
        $this->subDivisionCode = $this->subDivision->code;
        $this->dispatch('set-sub-division', $this->subDivisionCode);

        $this->code = $this->level->code;
        $this->name = $this->level->name;
        $this->description = $this->level->description;

        $this->actionForm = 'update';

        $this->dispatch('show-form');
    }

    /**
     * Updates the level details in the database.
     */
    public function update(): void
    {
        DB::transaction(function () {
            $this->level->update($this->levelData());
        }, 5);

        $this->dispatch('refresh');
        $this->dispatch('hide-form');
    }

    /**
     * Deletes the level from the database.
     */
    #[On('delete')]
    public function destroy($code): void
    {
        $this->level = Level::where('code', $code)->first();
        $this->level->code = $this->level->code.'-deleted';
        $this->level->save();
        $this->level->delete();

        $this->dispatch('refresh');
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.level-form');
    }
}