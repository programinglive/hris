<?php

namespace App\Livewire;

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

    public $subSubDivision;

    public $department;

    public $departmentId;

    public $departmentCode;

    public $departmentName;

    public $division;

    public $divisionId;

    public $divisionCode;

    public $divisionName;

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
     * The default data for the form.
     */
    public function subSubDivisionData(): array
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
     * Saves the subSubDivision details to the database and dispatches a 'subSubDivision-created' event.
     */
    public function save(): void
    {
        $this->validate();

        DB::transaction(function () {
            $this->subSubDivision = SubDivision::create($this->subSubDivisionData());
        }, 5);

        $this->dispatch('refresh');
        $this->dispatch('hide-form');
    }

    /**
     * Edit the subSubDivision details.
     */
    #[On('edit')]
    public function edit($code): void
    {
        $this->subSubDivision = SubDivision::where('code', $code)->first();
        $this->code = $this->subSubDivision->code;
        $this->name = $this->subSubDivision->name;
        $this->description = $this->subSubDivision->description;

        $this->companyId = $this->subSubDivision->company_id;
        $this->companyCode = $this->subSubDivision->company_code;
        $this->companyName = $this->subSubDivision->company_name;
        $this->dispatch('set-company', $this->companyCode);

        $this->branchId = $this->subSubDivision->branch_id;
        $this->branchCode = $this->subSubDivision->branch_code;
        $this->branchName = $this->subSubDivision->branch_name;
        $this->dispatch('set-branch', $this->branchCode);

        $this->departmentId = $this->subSubDivision->department_id;
        $this->departmentCode = $this->subSubDivision->department_code;
        $this->departmentName = $this->subSubDivision->department_name;
        $this->dispatch('set-department', $this->departmentCode);

        $this->divisionId = $this->subSubDivision->division_id;
        $this->divisionCode = $this->subSubDivision->division_code;
        $this->divisionName = $this->subSubDivision->division_name;
        $this->dispatch('set-division', $this->divisionCode);

        $this->actionForm = 'update';

        $this->dispatch('show-form');
    }

    /**
     * Updates the subSubDivision details in the database.
     */
    public function update(): void
    {
        $data = $this->subSubDivisionData();
        $data['updated_by'] = auth()->user()->id;

        DB::transaction(function () use ($data) {
            $this->subSubDivision->update($data);
        }, 5);

        $this->dispatch('refresh');
        $this->dispatch('hide-form');
    }

    /**
     * Deletes the subSubDivision from the database.
     */
    #[On('delete')]
    public function destroy($code): void
    {
        $this->subSubDivision = SubDivision::where('code', $code)->first();
        $this->subSubDivision->code = $this->subSubDivision->code.time().'-deleted';
        $this->subSubDivision->save();

        $this->subSubDivision->delete();

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
            'department',
            'departmentId',
            'departmentCode',
            'departmentName',
            'division',
            'divisionId',
            'divisionCode',
            'divisionName',
        ]);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.sub-division-form');
    }
}
