<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Division;
use DB;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

class DivisionForm extends Component
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

    public $division;

    public $department;

    public $departmentId;

    public $departmentCode;

    public $departmentName;

    public $createdBy;

    public $updatedBy;

    public $actionForm = 'save';

    /**
     * Mount the component
     */
    public function mount(): void
    {
        $this->createdBy = auth()->user()->id;
        $this->updatedBy = auth()->user()->id;
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
    public function divisionData(): array
    {
        return [
            'company_id' => $this->companyId,
            'branch_id' => $this->branchId,
            'department_id' => $this->departmentId,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'department_code' => $this->departmentCode,
            'department_name' => $this->departmentName,
            'company_code' => $this->companyCode,
            'company_name' => $this->companyName,
            'branch_code' => $this->branchCode,
            'branch_name' => $this->branchName,
            'created_by' => $this->createdBy,
        ];
    }

    /**
     * Saves the division details to the database and dispatches a 'division-created' event.
     */
    public function save(): void
    {
        $this->validate();

        DB::transaction(function () {
            $this->division = Division::create($this->divisionData());
        }, 5);

        $this->dispatch('refresh');
        $this->dispatch('hide-form');
    }

    /**
     * Edit the division details.
     */
    #[On('edit')]
    public function edit($code): void
    {
        $this->division = Division::where('code', $code)->first();
        $this->code = $this->division->code;
        $this->name = $this->division->name;
        $this->description = $this->division->description;

        $this->companyId = $this->division->company_id;
        $this->companyCode = $this->division->company_code;
        $this->companyName = $this->division->company_name;
        $this->dispatch('set-company', $this->companyCode);

        $this->branchId = $this->division->branch_id;
        $this->branchCode = $this->division->branch_code;
        $this->branchName = $this->division->branch_name;
        $this->dispatch('set-branch', $this->branchCode);

        $this->departmentId = $this->division->department_id;
        $this->departmentCode = $this->division->department_code;
        $this->departmentName = $this->division->department_name;
        $this->dispatch('set-department', $this->departmentCode);

        $this->actionForm = 'update';

        $this->dispatch('show-form');
    }

    /**
     * Updates the division details in the database.
     */
    public function update(): void
    {
        $data = $this->divisionData();
        $data['updated_by'] = $this->updatedBy;

        DB::transaction(function () use ($data) {
            $this->division->update($data);
        }, 5);

        $this->dispatch('refresh');
        $this->dispatch('hide-form');
    }

    /**
     * Deletes the division from the database.
     */
    #[On('delete')]
    public function destroy($code): void
    {
        $this->division = Division::where('code', $code)->first();
        $this->division->code = $this->division->code.time().'-deleted';
        $this->division->save();

        $this->division->delete();

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
        return view('livewire.division-form');
    }
}
