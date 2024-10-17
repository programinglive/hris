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

class AttendanceTimeTable extends Component
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

    public function importAttendanceTime(): void
    {
        $this->validate([
            'import' => 'required|mimes:csv,xlsx,xls',
        ]);

        $this->import->store(path: 'attendanceTimes');

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
     * Handles the event when an attendanceTime is created.
     *
     * @param  int  $attendanceTimeId  The ID of the created attendanceTime.
     */
    #[On('attendanceTime-created')]
    public function attendanceTimeAdded(int $attendanceTimeId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a attendanceTime is updated.
     *
     * @param  int  $attendanceTimeId  The ID of the updated attendanceTime.
     */
    #[On('attendanceTime-updated')]
    public function attendanceTimeUpdated(int $attendanceTimeId): void
    {
        $this->showForm = false;
    }

    #[On('resetError')]
    public function resetError(): void
    {
        $this->resetErrorBag();
    }

    /**
     * Handles the event when an attendanceTime is deleted.
     */
    #[On('attendanceTime-deleted')]
    public function attendanceTimeDeleted(): void
    {
        $this->showForm = false;
        $this->resetPage();
        $this->getAttendanceTime();
    }

    /**
     * Shows the form attendanceTime.
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Retrieves a paginated list of attendanceTimes based on a search query.
     *
     * @return LengthAwarePaginator The paginated list of attendanceTimes.
     */
    public function getAttendanceTime(): LengthAwarePaginator
    {
        $attendanceTimes = Attendance::where(function ($query) {
            $query->where('in', 'like', '%'.$this->search.'%')
                ->orWhere('out', 'like', '%'.$this->search.'%');
        });

        return $attendanceTimes->orderBy('id')
            ->paginate(5);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.attendance-time-table', [
            'attendanceTimes' => self::getAttendanceTime(),
        ]);
    }
}