<?php

namespace App\Livewire;

use App\Http\Controllers\BranchController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\WorkingCalendarController;
use App\Models\Company;
use App\Models\WorkingCalendar;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\SimpleExcel\SimpleExcelReader;

class WorkingCalendarTable extends Component
{
    use WithFileUploads, withPagination;

    public $showForm = false;

    #[Url]
    public $search;

    #[Url(keep: true)]
    public $companyCode;

    public $import;

    public function importWorkingCalendar(): void
    {
        $this->validate([
            'import' => 'required|mimes:csv,xlsx,xls',
        ]);

        $this->import->store(path: 'workingCalendars');

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

                $workingCalendar = WorkingCalendar::firstOrNew([
                    'name' => $name,
                ]);

                if (! $workingCalendar->code) {
                    $workingCalendar->company_id = $company->id;
                    $workingCalendar->branch_id = $branch->id ?? null;
                    $workingCalendar->code = WorkingCalendarController::generateCode();
                    $workingCalendar->company_code = $company->code;
                    $workingCalendar->company_name = $company->name;
                    $workingCalendar->branch_code = $branch->code ?? null;
                    $workingCalendar->branch_name = $branch->name ?? null;
                }

                $workingCalendar->save();
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
     * Handles the event when a workingCalendar is created.
     *
     * @param  int  $workingCalendarId  The ID of the created workingCalendar.
     */
    #[On('working-calendar-created')]
    public function workingCalendarAdded(int $workingCalendarId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a workingCalendar is updated.
     *
     * @param  int  $workingCalendarId  The ID of the updated workingCalendar.
     */
    #[On('working-calendar-updated')]
    public function workingCalendarUpdated(int $workingCalendarId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a workingCalendar is deleted.
     */
    #[On('working-calendar-deleted')]
    public function workingCalendarDeleted(): void
    {
        $this->showForm = false;
        $this->resetPage();
        $this->getWorkingCalendar();
    }

    /**
     * Shows the form workingCalendar.
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Retrieves a paginated list of workingCalendars based on a search query.
     *
     * @return LengthAwarePaginator The paginated list of workingCalendars.
     */
    public function getWorkingCalendar(): LengthAwarePaginator
    {
        $workingCalendars = WorkingCalendar::where(function ($query) {
            $query->where('code', 'like', '%'.$this->search.'%')
                ->orWhere('name', 'like', '%'.$this->search.'%');
        });

        if ($this->companyCode !== 'all') {
            $company = Company::where('code', $this->companyCode)->first();
            $workingCalendars = $workingCalendars->where(
                'company_id', $company?->id);
        }

        return $workingCalendars->orderBy('id')
            ->paginate(5);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.working-calendar-table', [
            'workingCalendars' => self::getWorkingCalendar(),
        ]);
    }
}