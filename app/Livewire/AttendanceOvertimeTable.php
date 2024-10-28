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

class AttendanceOvertimeTable extends Component
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
     * (CSV, XLSX, or XLS) and stores it in the 'attendanceOvertimes' directory.
     * It then uses
     * the SimpleExcelReader to read the uploaded file and iterates through each row to
     * find the corresponding company, branch, and employee based on the row data.
     * If all
     * entities are found, it creates a new attendance record in the Attendance model
     * with the necessary details.
     */
    public function importAttendanceOvertime(): void
    {
        $this->validate([
            'import' => 'required|mimes:csv,xlsx,xls',
        ]);

        $this->import->store(path: 'attendanceOvertimes');

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
    #[On('set-company')]
    public function setCompany(string $code): void
    {
        $this->companyCode = $code;
        $this->dispatch('refresh');
    }

    /**
     * Handles the event when an attendanceOvertime is created.
     *
     * @param  int  $attendanceOvertimeId  The ID of the created attendanceOvertime.
     */
    #[On('attendanceOvertime-created')]
    public function attendanceOvertimeAdded(int $attendanceOvertimeId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when an attendanceOvertime is updated.
     *
     * @param  int  $attendanceOvertimeId  The ID of the updated attendanceOvertime.
     */
    #[On('attendanceOvertime-updated')]
    public function attendanceOvertimeUpdated(int $attendanceOvertimeId): void
    {
        $this->showForm = false;
    }

    #[On('resetError')]
    public function resetError(): void
    {
        $this->resetErrorBag();
    }

    /**
     * Handles the event when an attendanceOvertime is deleted.
     */
    #[On('attendanceOvertime-deleted')]
    public function attendanceOvertimeDeleted(): void
    {
        $this->showForm = false;
        $this->resetPage();
        $this->getAttendanceOvertime();
    }

    /**
     * Shows the form attendanceOvertime.
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Hides the form attendanceOvertime.
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
     * Retrieves a paginated list of attendanceOvertimes based on a search query.
     *
     * @return LengthAwarePaginator The paginated list of attendanceOvertimes.
     */
    public function getAttendanceOvertime(): LengthAwarePaginator
    {
        $attendanceOvertimes = Attendance::where(function ($query) {
            $query->where('in', 'like', '%'.$this->search.'%')
                ->orWhere('out', 'like', '%'.$this->search.'%');
        });

        return $attendanceOvertimes->orderBy('id')
            ->paginate(10);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.attendance-overtime-table', [
            'attendanceOvertimes' => self::getAttendanceOvertime(),
        ]);
    }
}