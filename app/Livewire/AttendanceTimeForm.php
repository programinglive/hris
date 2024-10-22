<?php

namespace App\Livewire;

use App\Models\Attendance;
use App\Models\Branch;
use App\Models\Company;
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
     * Initialize the component by setting the company based on the company code.
     */
    public function mount(): void
    {
        if ($this->companyCode != 'all' && ! empty($this->companyCode)) {
            self::setCompany($this->companyCode);
        }

        if ($this->branchCode != 'all' && ! empty($this->branchCode)) {
            self::setBranch($this->branchCode);
        }

        $this->createdBy = auth()->user()->id;
        $this->updatedBy = auth()->user()->id;
    }

    /**
     * Set the company based on the company code
     *
     * @param  string  $companyCode  The code of the company.
     */
    #[On('setCompany')]
    public function setCompany(string $companyCode): void
    {
        $this->companyCode = $companyCode;

        if ($companyCode != 'all') {
            $this->company = Company::where('code', $companyCode)->first();
            $this->companyId = $this->company->id;
            $this->companyCode = $this->company->code;
            $this->companyName = $this->company->name;
        }
    }

    /**
     * Set the branch ID for the details.
     *
     * @param  string  $branchCode  The ID of the branch.
     */
    #[On('setBranch')]
    public function setBranch(string $branchCode): void
    {
        $this->branchCode = $branchCode;

        if ($branchCode != 'all') {
            $this->branch = Branch::where('code', $branchCode)->first();
            $this->branchId = $this->branch->id;
            $this->branchCode = $this->branch->code;
            $this->branchName = $this->branch->name;
        }
    }

    /**
     * The default data for the form.
     */
    /**
     * Get the default data for the form.
     */
    public function attendanceTimeData(): array
    {
        $this->duration = (strtotime($this->out) - strtotime($this->in)) / 60;

        return [
            'company_id' => $this->companyId,
            'branch_id' => $this->branchId,
            'employee_id' => $this->employeeId,
            'employee_nik' => $this->employeeNik,
            'employee_name' => $this->employeeName,
            'date' => $this->date,
            'in' => $this->in,
            'out' => $this->out,
            'duration' => $this->duration,
            'status' => $this->status,
            'company_code' => $this->companyCode,
            'company_name' => $this->companyName,
            'branch_code' => $this->branchCode,
            'branch_name' => $this->branchName,
            'created_by' => $this->createdBy,
        ];
    }

    /**
     * Resets the error bag when an update is made to the form.
     *
     * This function is automatically triggered when any of the form's properties
     * are updated, ensuring that any validation errors are cleared.
     */
    public function updated(): void
    {
        $this->resetErrorBag();
    }

    /**
     * Sets the employee data.
     *
     * @param  array  $employee  The employee data.
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
        foreach ([
            'company' => 'Company',
            'branch' => 'Branch',
            'employee' => 'Employee',
        ] as $property => $label) {
            if (! $this->$property) {
                $this->dispatch('error-message', "$label is required");

                return;
            }
        }

        $this->validate();

        DB::transaction(function () {
            $this->attendanceTime = Attendance::create($this->attendanceTimeData());
        }, 5);

        $this->resetExcept([
            'company',
            'companyId',
            'companyCode',
            'companyName',
            'branch',
            'branchId',
            'branchCode',
            'branchName',
            'createdBy',
            'updatedBy',
        ]);

        $this->dispatch('hide-form');
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
    }

    #[On('error-message')]
    public function errorMessage($message): void
    {
        $this->add('errorMessage', $message);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.attendance-time-form');
    }
}
