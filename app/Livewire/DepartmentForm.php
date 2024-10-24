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

    public $companyId;

    #[Url(keep: true)]
    public $companyCode;

    public $companyName;

    public $branch;

    public $branchId;

    #[Url(keep: true)]
    public $branchCode;

    public $branchName;

    #[Validate('required|min:3')]
    public $code;

    #[Validate('required|min:3')]
    public $name;

    public $description;

    public $department;

    public $createdBy;

    public $updatedBy;

    public $actionForm = 'save';

    /**
     * Mount the component
     */
    public function mount(): void
    {
        $this->createdBy = auth()->user()->id;
    }

    /**
     * Sets the value of the companyCode property to the given code.
     *
     * @param  string  $code  The code to set the companyCode property to.
     */
    #[On('set-company')]
    public function setCompany(string $code): void
    {
        if ($code == '') {
            $this->reset('companyId');

            return;
        }

        if ($code != 'all') {
            $this->companyCode = $code;
            $this->company = Company::where('code', $code)->first();
            $this->companyId = $this->company->id;
            $this->companyCode = $this->company->code;
            $this->companyName = $this->company->name;
        }
    }

    /**
     * Sets the value of the brandCode property to the given code.
     *
     * @param  string  $code  The code to set the brandCode property to.
     */
    #[On('set-branch')]
    public function setBranch(string $code): void
    {
        if ($code == '') {
            $this->reset('branchId');

            return;
        }

        if ($code != 'all') {
            $this->branchCode = $code;
            $this->branch = Branch::where('code', $code)->first();
            $this->branchId = $this->branch->id;
            $this->branchCode = $this->branch->code;
            $this->branchName = $this->branch->name;
        }
    }

    /**
     * The default data for the form.
     */
    public function departmentData(): array
    {
        return [
            'company_id' => $this->companyId,
            'branch_id' => $this->branchId,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'company_code' => $this->companyCode,
            'company_name' => $this->companyName,
            'branch_code' => $this->branchCode,
            'branch_name' => $this->branchName,
            'created_by' => $this->createdBy,
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
        $this->department = Department::where('code', $code)->first();
        $this->code = $this->department->code;
        $this->name = $this->department->name;
        $this->description = $this->department->description;

        $this->companyId = $this->department->company_id;
        $this->companyCode = $this->department->company_code;
        $this->companyName = $this->department->company_name;
        $this->dispatch('setCompany', $this->companyCode);

        $this->branchId = $this->department->branch_id;
        $this->branchCode = $this->department->branch_code;
        $this->branchName = $this->department->branch_name;
        $this->dispatch('setBranch', $this->branchCode);

        $this->actionForm = 'update';

        $this->dispatch('show-form');
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
        $this->department->code = $this->department->code.'-deleted';
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
            'createdBy',
            'updatedBy',
            'company',
            'companyId',
            'companyCode',
            'companyName',
            'branch',
            'branchId',
            'branchCode',
            'branchName',
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