<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;
use App\Models\Division;
use App\Models\Level;
use App\Models\Position;
use App\Models\SubDivision;
use DB;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PositionForm extends Component
{
    public $company;

    #[Url(keep:true)]
    public $companyCode;

    public $branch;

    #[Url(keep:true)]
    public $branchCode;

    public $department;

    public $departmentCode;

    public $division;

    public $divisionCode;

    public $subDivision;

    public $subDivisionCode;

    public $level;

    public $levelCode;


    #[Validate('required|unique:positions|min:3')]
    public $code;

    #[Validate('required|min:3')]
    public $name;

    public $description;

    public $position;

    public $actionForm = 'save';

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

    #[On('set-level')]
    public function setLevel($levelCode): void
    {
        $this->level = Level::where('code', $levelCode)->first();
        $this->levelCode = $levelCode;
    }

    /**
     * The default data for the form.
     */
    public function positionData(): array
    {
        return [
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'department_id' => $this->department->id,
            'division_id' => $this->division->id,
            'sub_division_id' => $this->subDivision->id,
            'level_id' => $this->level->id,
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
            'level_code' => $this->level->code,
            'level_name' => $this->level->name,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'created_by' => auth()->user()->id,
        ];
    }

    /**
     * Saves the position details to the database and dispatches a 'position-created' event.
     */
    public function save(): void
    {
        $this->validate();

        DB::transaction(function () {
            Position::create($this->positionData());
        }, 5);

        $this->dispatch('refresh');
        $this->dispatch('hide-form');
    }

    /**
     * Edit the position details.
     */
    #[On('edit')]
    public function edit($code): void
    {
        $this->position = Position::where('code', $code)->first();

        $this->company = Company::where('code', $this->position->company_code)->first();
        $this->companyCode = $this->position->company_code;
        $this->dispatch('set-company', $this->companyCode);

        $this->branch = Branch::where('code', $this->position->branch_code)->first();
        $this->branchCode = $this->position->branch_code;
        $this->dispatch('set-branch', $this->branchCode);

        $this->department = Department::where('code', $this->position->department_code)->first();
        $this->departmentCode = $this->position->department_code;
        $this->dispatch('set-department', $this->departmentCode);

        $this->division = Division::where('code', $this->position->division_code)->first();
        $this->divisionCode = $this->position->division_code;
        $this->dispatch('set-division', $this->divisionCode);

        $this->subDivision = SubDivision::where('code', $this->position->sub_division_code)->first();
        $this->subDivisionCode = $this->position->sub_division_code;
        $this->dispatch('set-sub-division', $this->subDivisionCode);

        $this->level = Level::where('code', $this->position->level_code)->first();
        $this->levelCode = $this->position->level_code;
        $this->dispatch('set-level', $this->levelCode);

        $this->code = $this->position->code;
        $this->name = $this->position->name;
        $this->description = $this->position->description;

        $this->actionForm = 'update';

        $this->dispatch('show-form');
    }

    /**
     * Updates the position details in the database.
     */
    public function update(): void
    {
        DB::transaction(function () {
            $this->position->update($this->positionData());
        }, 5);


        $this->dispatch('refresh');
        $this->dispatch('hide-form');
    }

    /**
     * Deletes the position from the database.
     */
    #[On('delete')]
    public function destroy($code): void
    {
        $this->position = Position::where('code', $code)->first();
        $this->position->code = $code.time().'-deleted';
        $this->position->save();

        $this->position->delete();

        $this->dispatch('refresh');
    }

    #[On('clear-form')]
    public function clearForm(): void
    {
        $this->reset();
        $this->resetErrorBag();
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.position-form');
    }
}