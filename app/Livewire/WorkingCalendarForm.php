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
    public $companyCode = 'all';
    public $companyName;

    public $branch;
    public $branchId;
    #[Url(keep: true)]
    public $branchCode = 'all';
    public $branchName;

    #[Validate('required|min:3')]
    public $date;

    public $start;
    public $end;
    public $type;
    public $description;

    public $createdBy;
    public $updatedBy;

    public $workingCalendar;

    public $actionForm = 'save';

    /**
     * Mount the component
     * @return void
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
            'start' => $this->start,
            'end' => $this->end,
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
        $this->validate();

        DB::transaction(function () {
            $this->workingCalendar = WorkingCalendar::create($this->workingCalendarData());
        }, 5);

        $this->dispatch('working-calendar-created', workingCalendarId: $this->workingCalendar->id);

        $this->reset();
    }

    /**
     * Edit the workingCalendar details.
     */
    #[On('edit')]
    public function edit($date): void
    {
        $this->workingCalendar = WorkingCalendar::where('date', $date)->first();
        $this->date = $this->workingCalendar->date;
        $this->start = $this->workingCalendar->start;
        $this->end = $this->workingCalendar->end;
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
        DB::transaction(function () {
            $this->workingCalendar->update($this->workingCalendarData());
        }, 5);

        $this->dispatch('working-calendar-updated', workingCalendarId: $this->workingCalendar->id);

        $this->reset();
    }

    /**
     * Deletes the workingCalendar from the database.
     */
    #[On('delete')]
    public function destroy($date): void
    {
        $this->workingCalendar = WorkingCalendar::where('date', $date)->first();
        $this->workingCalendar->delete();

        $this->reset();

        $this->dispatch('working-calendar-deleted', refreshCompanies: true);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.working-calendar-form');
    }
}