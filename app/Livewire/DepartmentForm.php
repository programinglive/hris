<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;
use DB;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

class DepartmentForm extends Component
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

    public $department;

    public $actionForm = 'save';

    #[On('set-company')]
    public function setCompany($companyCode): void
    {
        $this->companyCode = $companyCode;
        $this->company = Company::where('code', $companyCode)->first();
    }

    #[On('set-branch')]
    public function setBranch($branchCode): void
    {
        $this->branchCode = $branchCode;
        $this->branch = Branch::where('code', $branchCode)->first();
    }

    /**
     * The default data for the form.
     */
    public function departmentData(): array
    {
        return [
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'company_code' => $this->companyCode,
            'company_name' => $this->company->name,
            'branch_code' => $this->branchCode,
            'branch_name' => $this->branch->name,
            'created_by' => auth()->user()->id,
        ];
    }

    /**
     * Saves the department details to the database and dispatches a 'department-created' event.
     */
    public function save(): void
    {
        $this->validate();

        DB::transaction(function () {
            $this->department = Department::create($this->departmentData());
        }, 5);

        $this->dispatch('refresh');
        $this->dispatch('hide-form');
    }

    /**
     * Edit the department details.
     */
    #[On('edit')]
    public function edit($code): void
    {
        $this->dispatch('show-form');

        $this->department = Department::where('code', $code)->first();
        $this->code = $this->department->code;
        $this->name = $this->department->name;
        $this->description = $this->department->description;

        $this->company = Company::where('code', $this->department->company_code)->first();
        $this->companyCode = $this->department->company_code;
        $this->dispatch('set-company', $this->companyCode);

        $this->dispatch('get-branch', $this->companyCode);

        $this->branch = Branch::where('code', $this->department->branch_code)->first();
        $this->branchCode = $this->department->branch_code;
        $this->dispatch('set-branch', $this->branchCode);

        $this->actionForm = 'update';
    }

    /**
     * Updates the department details in the database.
     */
    public function update(): void
    {
        $data = $this->departmentData();
        $data['updated_by'] = auth()->user()->id;
        
        DB::transaction(function () use ($data) {
            $this->department->update($data);
        }, 5);

        $this->dispatch('refresh');
        $this->dispatch('hide-form');
    }

    /**
     * Deletes the department from the database.
     */
    #[On('delete')]
    public function destroy($code): void
    {
        $this->department = Department::where('code', $code)->first();
        $this->department->code = $this->department->code.time().'-deleted';
        $this->department->save();

        $this->department->delete();

        $this->dispatch('refresh');
    }

    /**
     * Resets the form values except for the given properties.
     */
    public function getResetExcept(): void
    {
        $this->resetExcept([
            'company',
            'companyCode',
            'branch',
            'branchCode',
        ]);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.department-form');
    }
}