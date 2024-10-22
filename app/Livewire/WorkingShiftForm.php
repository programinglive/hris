<?php

namespace App\Livewire;

use App\Models\Company;
use App\Models\WorkingShift;
use DB;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Url;
use Livewire\Component;

class WorkingShiftForm extends Component
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

    public $description;

    public $createdBy;

    public $updatedBy;

    public $workingShift;

    #[Rule('required')]
    public $name;

    #[Rule('required')]
    public $startTime;

    #[Rule('required')]
    public $endTime;

    public $actionForm = 'save';

    /**
     * Mount the component
     */
    public function mount(): void
    {
        $this->company = Company::first();
        $this->companyCode = $this->company->code;
        $this->companyName = $this->company->name;

        $this->branch = $this->company->branches->first();
        $this->branchCode = $this->branch->code;
        $this->branchName = $this->branch->name;

        $this->createdBy = auth()->user()->id;
        $this->updatedBy = auth()->user()->id;
    }

    /**
     * Updates the specified property with the given value and performs validation if the property is 'date',
     * 'email', or 'phone'.
     *
     * @param  string  $key  The name of the property to be updated.
     * @param  mixed  $value  The new value for the property.
     *
     * @throws ValidationException
     */
    public function updated(string $key, mixed $value): void
    {
        if ($key == 'date') {
            $this->validateOnly($key);
        }
    }

    /**
     * The default data for the form.
     */
    public function workingShiftData(): array
    {
        return [
            'company_id' => $this->companyId,
            'branch_id' => $this->branchId,
            'name' => $this->name,
            'start_time' => $this->startTime,
            'end_time' => $this->endTime,
            'description' => $this->description,
            'company_date' => $this->companyCode,
            'company_name' => $this->companyName,
            'branch_date' => $this->branchCode,
            'branch_name' => $this->branchName,
            'created_by' => $this->createdBy,
            'updated_by' => $this->updatedBy,
        ];
    }

    /**
     * Saves the workingShift details to the database and dispatches a 'workingShift-created' event.
     */
    public function save(): void
    {
        foreach ([
            'company' => 'Company',
            'branch' => 'Branch',
        ] as $property => $label) {
            if (! $this->$property) {
                $this->dispatch('error-message', "$label is required");

                return;
            }
        }

        $this->validate();

        DB::transaction(function () {
            $this->workingShift = WorkingShift::create($this->workingShiftData());
        }, 5);

        $this->getResetExcept();

        $this->dispatch('refresh');
        $this->dispatch('hide-form');
    }

    /**
     * Edit the workingShift details.
     */
    #[On('edit')]
    public function edit($id): void
    {
        $this->workingShift = WorkingShift::find($id);
        $this->name = $this->workingShift->name;
        $this->startTime = $this->workingShift->start_time;
        $this->endTime = $this->workingShift->end_time;
        $this->description = $this->workingShift->description;

        $this->actionForm = 'update';

        $this->dispatch('show-form');
    }

    /**
     * Updates the workingShift details in the database.
     */
    public function update(): void
    {
        foreach ([
            'company' => 'Company',
            'branch' => 'Branch',
        ] as $property => $label) {
            if (! $this->$property) {
                $this->dispatch('error-message', "$label is required");

                return;
            }
        }

        DB::transaction(function () {
            $this->workingShift->update($this->workingShiftData());
        }, 5);

        $this->getResetExcept();

        $this->dispatch('refresh');
        $this->dispatch('hide-form');
    }

    /**
     * Deletes the workingShift from the database.
     */
    #[On('delete')]
    public function destroy($id): void
    {
        $this->workingShift = WorkingShift::find($id);
        $this->workingShift->delete();

        $this->dispatch('refresh');
    }

    /**
     * Dispatches an 'error-message' event with the given message.
     */
    #[On('error-message')]
    public function errorMessage(string $message): void
    {
        $this->addError('errorMessage', $message);
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
        return view('livewire.working-shift-form');
    }
}
