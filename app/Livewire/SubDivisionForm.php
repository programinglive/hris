<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;
use App\Models\Division;
use App\Models\SubDivision;
use DB;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SubDivisionForm extends Component
{
    public $company;

    #[Url(keep: true)]
    public $companyCode;

    public $branch;

    #[Url(keep: true)]
    public $branchCode;

    #[Validate('required|min:3')]
    public $code;

    #[Validate('required|min:3')]
    public $name;

    public $description;

    public $subDivision;

    public $department;

    public $departmentCode;

    public $division;

    public $divisionCode;

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

    /**
     * The default data for the form.
     */
    public function subDivisionData(): array
    {
        return [
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'department_id' => $this->department->id,
            'division_id' => $this->division->id,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'company_code' => $this->company->code,
            'company_name' => $this->company->name,
            'branch_code' => $this->branch->code,
            'branch_name' => $this->branch->name,
            'department_code' => $this->department->code,
            'department_name' => $this->department->name,
            'division_code' => $this->division->code,
            'division_name' => $this->division->name,
        ];
    }

    /**
     * Saves the subDivision details to the database and dispatches a 'subDivision-created' event.
     */
    public function save(): void
    {
        $this->validate();

        DB::transaction(function () {
            $this->subDivision = SubDivision::create($this->subDivisionData());
        }, 5);

        $this->dispatch('refresh');
        $this->dispatch('hide-form');
    }

    /**
     * Edit the subDivision details.
     */
    #[On('edit')]
    public function edit($code): void
    {
        $this->subDivision = SubDivision::where('code', $code)->first();
        $this->code = $this->subDivision->code;
        $this->name = $this->subDivision->name;
        $this->description = $this->subDivision->description;

        $this->companyCode = $this->subDivision->company_code;
        $this->company = $this->subDivision->company;
        $this->dispatch('set-company', $this->companyCode);

        $this->branchCode = $this->subDivision->branch_code;
        $this->branch = $this->subDivision->branch;
        $this->dispatch('set-branch', $this->branchCode);

        $this->departmentCode = $this->subDivision->department_code;
        $this->department = $this->subDivision->department;
        $this->dispatch('set-department', $this->departmentCode);

        $this->divisionCode = $this->subDivision->division_code;
        $this->division = $this->subDivision->division;
        $this->dispatch('set-division', $this->divisionCode);

        $this->actionForm = 'update';

        $this->dispatch('show-form');
    }

    /**
     * Updates the subDivision details in the database.
     */
    public function update(): void
    {
        $data = $this->subDivisionData();
        $data['updated_by'] = auth()->user()->id;

        DB::transaction(function () use ($data) {
            $this->subDivision->update($data);
        }, 5);

        $this->dispatch('refresh');
        $this->dispatch('hide-form');
    }

    /**
     * Deletes the subDivision from the database.
     */
    #[On('delete')]
    public function destroy($code): void
    {
        $this->subDivision = SubDivision::where('code', $code)->first();
        $this->subDivision->code = $this->subDivision->code.time().'-deleted';
        $this->subDivision->save();

        $this->subDivision->delete();

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
        return view('livewire.sub-division-form');
    }
}
