<?php

namespace App\Livewire;

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CompanyController;
use App\Models\Attendance;
use App\Models\Company;
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

    #[Url(keep: true)]
    public $companyCode = 'all';

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
                $name = trim(
                    strtolower(
                        str_replace(' ', '', $rowProperties['name'])
                    )
                );

                $company = Company::firstOrNew([
                    'name' => $rowProperties['company_name'],
                ]);

                if (! $company->code) {
                    $company->code = CompanyController::generateCode();
                }

                $company->save();

                if ($rowProperties['branch_name']) {
                    $branch = BranchController::createByName($company, $rowProperties['branch_name']);
                }

                $attendanceTime = Attendance::firstOrNew([
                    'name' => $name,
                ]);

                if (! $attendanceTime->code) {
                    $attendanceTime->company_id = $company->id;
                    $attendanceTime->branch_id = $branch->id ?? null;
                    $attendanceTime->code = AttendanceController::generateCode();
                    $attendanceTime->company_code = $company->code;
                    $attendanceTime->company_name = $company->name;
                    $attendanceTime->branch_code = $branch->code ?? null;
                    $attendanceTime->branch_name = $branch->name ?? null;
                }

                $attendanceTime->save();
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
     * Handles the event when a attendanceTime is created.
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

    /**
     * Handles the event when a attendanceTime is deleted.
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

        if ($this->companyCode !== 'all') {
            $attendanceTimes = $attendanceTimes->where('company_id', Company::where('code', $this->companyCode)->first()?->id);
        }

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
