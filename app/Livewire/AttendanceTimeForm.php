<?php

namespace App\Livewire;

use App\Models\Attendance;
use DB;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AttendanceTimeForm extends Component
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

    public $employee;
    public $employeeCode;
    public $employeeName;

    public $in;
    public $out;
    public $duration;

    public $attendanceTime;

    public $status;

    public $createdBy;
    public $updatedBy;

    public $actionForm = 'save';

    /**
     * The default data for the form.
     */
    public function attendanceTimeData(): array
    {
        return [
            'company_id' => 1,
            'branch_id' => 1,
            'employee_id' => 1,
            'employee_code' => $this->employeeCode,
            'employee_name' => $this->employeeName,
            'in' => $this->in,
            'out' => $this->out,
            'duration' => $this->duration,
            'company_in' => $this->companyCode,
            'company_name' => $this->companyName,
            'branch_in' => $this->branchCode,
            'branch_name' => $this->branchName,
            'created_bt' => $this->createdBy,
            'updated_by' => $this->updatedBy,
        ];
    }

    /**
     * Saves the attendanceTime details to the database and dispatches a 'attendanceTime-created' event.
     */
    public function save(): void
    {
        $this->validate();

        DB::transaction(function () {
            $this->attendanceTime = Attendance::create($this->attendanceTimeData());
        }, 5);

        $this->dispatch('attendance-time-created', attendanceTimeId: $this->attendanceTime->id);

        $this->reset();
    }

    /**
     * Edit the attendanceTime details.
     */
    #[On('edit')]
    public function edit($in): void
    {
        $this->attendanceTime = Attendance::where('in', $in)->first();
        $this->in = $this->attendanceTime->in;

        $this->actionForm = 'update';

        $this->dispatch('show-form');
    }

    /**
     * Updates the attendanceTime details in the database.
     */
    public function update(): void
    {
        DB::transaction(function () {
            $this->attendanceTime->update($this->attendanceTimeData());
        }, 5);

        $this->dispatch('attendance-time-updated', attendanceTimeId: $this->attendanceTime->id);

        $this->reset();
    }

    /**
     * Deletes the attendanceTime from the database.
     */
    #[On('delete')]
    public function destroy($attendanceId): void
    {
        $this->attendanceTime = Attendance::find($attendanceId);
        $this->attendanceTime->in = $this->attendanceTime->in.'-deleted';
        $this->attendanceTime->save();

        $this->attendanceTime->delete();

        $this->reset();

        $this->dispatch('attendance-time-deleted', refreshCompanies: true);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.attendance-time-form');
    }
}