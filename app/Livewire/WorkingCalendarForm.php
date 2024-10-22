<?php

namespace App\Livewire;

use App\Models\Company;
use App\Models\WorkingCalendar;
use DB;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

class WorkingCalendarForm extends Component
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

    #[Validate('required')]
    public $date;

    #[Validate('required')]
    public $type;

    public $description;

    public $createdBy;

    public $updatedBy;

    public $workingCalendar;

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
    public function workingCalendarData(): array
    {
        return [
            'company_id' => 1,
            'branch_id' => 1,
            'date' => $this->date,
            'type' => $this->type,
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
     * Saves the workingCalendar details to the database and dispatches a 'workingCalendar-created' event.
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
            $this->workingCalendar = WorkingCalendar::create($this->workingCalendarData());
        }, 5);

        $this->getResetExcept();

        $this->dispatch('hide-form');
    }

    /**
     * Edit the workingCalendar details.
     */
    #[On('edit')]
    public function edit($id): void
    {
        $this->workingCalendar = WorkingCalendar::find($id);
        $this->date = $this->workingCalendar->date;
        $this->type = $this->workingCalendar->type;
        $this->description = $this->workingCalendar->description;

        $this->actionForm = 'update';

        $this->dispatch('show-form');
    }

    /**
     * Updates the workingCalendar details in the database.
     */
    public function update(): void
    {
        foreach ([
                  'company' => 'Company',
                  'branch' => 'Branch',
              ] as $property => $label) {
            if (!$this->$property) {
                $this->dispatch('error-message', "$label is required");

                return;
            }
        }

        DB::transaction(function () {
            $this->workingCalendar->update($this->workingCalendarData());
        }, 5);

        $this->getResetExcept();

        $this->dispatch('hide-form');

    }

    /**
     * Deletes the workingCalendar from the database.
     */
    #[On('delete')]
    public function destroy($id): void
    {
        $this->workingCalendar = WorkingCalendar::find($id);
        $this->workingCalendar->delete();

        $this->dispatch('refresh');
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.working-calendar-form');
    }

    /**
     * @return void
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
}