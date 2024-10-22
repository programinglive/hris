<?php

namespace App\Livewire;

use App\Models\Attendance;
use App\Models\Branch;
use App\Models\Company;
use App\Models\UserDetail;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\SimpleExcel\SimpleExcelReader;

class AttendanceSwitchOffTable extends Component
{
    use WithFileUploads, withPagination;

    public $showForm = false;

    #[Url]
    public $search;

    public $employee;

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

    public $import;

    /**
     * Import attendance time data from an uploaded file.
     *
     * This function validates the uploaded file to ensure it is in the correct format
     * (CSV, XLSX, or XLS) and stores it in the 'attendanceSwitchOffs' directory.
     * It then uses
     * the SimpleExcelReader to read the uploaded file and iterates through each row to
     * find the corresponding company, branch, and employee based on the row data.
     * If all
     * entities are found, it creates a new attendance record in the Attendance model
     * with the necessary details.
     */
    public function importAttendanceSwitchOff(): void
    {
        $this->validate([
            'import' => 'required|mimes:csv,xlsx,xls',
        ]);

        $this->import->store(path: 'attendanceSwitchOffs');

        $this->import = $this->import->path();

        SimpleExcelReader::create($this->import)->getRows()
            ->each(function (array $rowProperties) {

                $this->company = Company::where('code', $rowProperties['comp_code'])->first();

                $this->branch = Branch::where('code', $rowProperties['branch_code'])->first();

                $this->employee = UserDetail::where('nik', $rowProperties['nik'])->first();

                if ($this->company && $this->branch && $this->employee) {
                    Attendance::create([
                        'company_id' => $this->company->id,
                        'branch_id' => $this->branch->id,
                        'company_code' => $this->company->code,
                        'company_name' => $this->company->name,
                        'branch_code' => $this->branch->code,
                        'branch_name' => $this->branch->name,
                        'employee_id' => $this->employee->id,
                        'employee_nik' => $rowProperties['nik'],
                        'employee_name' => $this->employee->first_name,
                        'created_by' => auth()->user()->id,
                        'date' => $rowProperties['date'],
                        'in' => $rowProperties['in'],
                        'out' => $rowProperties['out'],
                        'duration' => (strtotime($rowProperties['out']) - strtotime($rowProperties['in'])) / 60,
                        'status' => $rowProperties['status'],
                    ]);

                } else {
                    $this->addError('errorMessage', 'No data Submited');
                }

            });

        redirect()->back();
    }

    /**
     * Sets the company code.
     *
     * @param  string  $code  The code to set as the company code.
     */
    #[On('setCompany')]
    public function setCompany(string $code): void
    {
        $this->companyCode = $code;
    }

    /**
     * Handles the event when an attendanceSwitchOff is created.
     *
     * @param  int  $attendanceSwitchOffId  The ID of the created attendanceSwitchOff.
     */
    #[On('attendanceSwitchOff-created')]
    public function attendanceSwitchOffAdded(int $attendanceSwitchOffId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when an attendanceSwitchOff is updated.
     *
     * @param  int  $attendanceSwitchOffId  The ID of the updated attendanceSwitchOff.
     */
    #[On('attendanceSwitchOff-updated')]
    public function attendanceSwitchOffUpdated(int $attendanceSwitchOffId): void
    {
        $this->showForm = false;
    }

    #[On('resetError')]
    public function resetError(): void
    {
        $this->resetErrorBag();
    }

    /**
     * Handles the event when an attendanceSwitchOff is deleted.
     */
    #[On('attendanceSwitchOff-deleted')]
    public function attendanceSwitchOffDeleted(): void
    {
        $this->showForm = false;
        $this->resetPage();
        $this->getAttendanceSwitchOff();
    }

    /**
     * Shows the form attendanceSwitchOff.
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Hides the form attendanceSwitchOff.
     */
    #[On('hide-form')]
    public function hideForm(): void
    {
        $this->showForm = false;
    }

    #[On('error-message')]
    public function errorMessage($message): void
    {
        $this->addError('errorMessage', $message);
    }

    #[On('clear-error')]
    public function clearError(): void
    {
        $this->resetErrorBag();
    }

    /**
     * Retrieves a paginated list of attendanceSwitchOffs based on a search query.
     *
     * @return LengthAwarePaginator The paginated list of attendanceSwitchOffs.
     */
    public function getAttendanceSwitchOff(): LengthAwarePaginator
    {
        $attendanceSwitchOffs = Attendance::where(function ($query) {
            $query->where('in', 'like', '%'.$this->search.'%')
                ->orWhere('out', 'like', '%'.$this->search.'%');
        });

        return $attendanceSwitchOffs->orderBy('id')
            ->paginate(5);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.attendance-switch-off-table', [
            'attendanceSwitchOffs' => self::getAttendanceSwitchOff(),
        ]);
    }
}
