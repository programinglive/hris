<?php

namespace App\Livewire;

use App\Http\Controllers\BranchController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\WorkingShiftController;
use App\Models\Company;
use App\Models\WorkingShift;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\SimpleExcel\SimpleExcelReader;

class WorkingShiftTable extends Component
{
    use WithFileUploads, withPagination;

    public $showForm = false;

    #[Url]
    public $search;

    #[Url(keep: true)]
    public $companyCode;

    public $import;

    public function importWorkingShift(): void
    {
        $this->validate([
            'import' => 'required|mimes:csv,xlsx,xls',
        ]);

        $this->import->store(path: 'workingShifts');

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

                $workingShift = WorkingShift::firstOrNew([
                    'name' => $name,
                ]);

                if (! $workingShift->code) {
                    $workingShift->company_id = $company->id;
                    $workingShift->branch_id = $branch->id ?? null;
                    $workingShift->code = WorkingShiftController::generateCode();
                    $workingShift->company_code = $company->code;
                    $workingShift->company_name = $company->name;
                    $workingShift->branch_code = $branch->code ?? null;
                    $workingShift->branch_name = $branch->name ?? null;
                }

                $workingShift->save();
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
     * Handles the event when a workingShift is created.
     *
     * @param  int  $workingShiftId  The ID of the created workingShift.
     */
    #[On('working-shift-created')]
    public function workingShiftAdded(int $workingShiftId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a workingShift is updated.
     *
     * @param  int  $workingShiftId  The ID of the updated workingShift.
     */
    #[On('working-shift-updated')]
    public function workingShiftUpdated(int $workingShiftId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a workingShift is deleted.
     */
    #[On('working-shift-deleted')]
    public function workingShiftDeleted(): void
    {
        $this->showForm = false;
        $this->resetPage();
        $this->getWorkingShift();
    }

    /**
     * Shows the form workingShift.
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Retrieves a paginated list of workingShifts based on a search query.
     *
     * @return LengthAwarePaginator The paginated list of workingShifts.
     */
    public function getWorkingShift(): LengthAwarePaginator
    {
        $workingShifts = WorkingShift::where(function ($query) {
            $query->where('code', 'like', '%'.$this->search.'%')
                ->orWhere('name', 'like', '%'.$this->search.'%');
        });

        if ($this->companyCode !== 'all') {
            $company = Company::where('code', $this->companyCode)->first();
            $workingShifts = $workingShifts->where(
                'company_id', $company?->id);
        }

        return $workingShifts->orderBy('id')
            ->paginate(5);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.working-shift-table', [
            'workingShifts' => self::getWorkingShift(),
        ]);
    }
}
