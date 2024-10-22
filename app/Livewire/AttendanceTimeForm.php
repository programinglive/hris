<?php

namespace App\Livewire;

use App\Models\Attendance;
use DB;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Url;
use Livewire\Component;

class AttendanceTimeForm extends Component
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

    public $employee;
    public $employeeId;

    public $employeeNik;

    public $employeeName;

    #[Rule('required')]
    public $date;

    #[Rule('required')]
    public $in;

    #[Rule('required')]
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
    /**
     * Get the default data for the form.
     *
     * @return array
     */
    public function attendanceTimeData(): array
    {
        return [
            'company_id' => $this->companyId,
            'branch_id' => $this->branchId,
            'employee_id' => $this->employeeId,
            'employee_nik' => $this->employeeNik,
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
     * Resets the error bag when an update is made to the form.
     *
     * This function is automatically triggered when any of the form's properties
     * are updated, ensuring that any validation errors are cleared.
     *
     * @return void
     */
    public function updated(): void
    {
        $this->resetErrorBag();
    }

    /**
     * Sets the employee data.
     *
     * @param array $employee  The employee data.
     */
    #[On('set-employee')]
    public function setEmployee(array $employee): void
    {
        $this->employee = $employee;
        $this->employeeId = $employee['id'];
        $this->employeeNik = $employee['nik'];
        $this->employeeName = $employee['name'];
    }

    /**
     * Saves the attendanceTime details to the database and dispatches an 'attendanceTime-created' event.
     */
    public function save(): void
    {
        if (!$this->company) {
            $this->dispatch('errorMessage', 'Company is required');

            return;
        }

        if (!$this->branch) {
            $this->dispatch('errorMessage', 'Branch is required');

            return;
        }

        if (!$this->employee) {
            $this->dispatch('errorMessage', 'Employee is required');

            return;
        }

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