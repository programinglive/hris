<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Company;
use App\Models\WorkingCalendar;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportWorkingCalendar extends Component
{
    use WithFileUploads;

    public $workingCalendar;

    public $company;

    public $companyId;

    public $companyCode;

    public $companyName;

    public $branch;

    public $branchId;

    public $branchCode;

    public $branchName;

    public $import;

    /**
     * Called when the import value is updated.
     */
    public function updatedImport(): void
    {
        $this->importWorkingCalendar();
    }

    public function importWorkingCalendar(): void
    {
        $this->validate([
            'import' => 'required|mimes:csv,xlsx,xls',
        ]);

        $this->import->store(path: 'workingCalendars');

        $this->import = $this->import->path();

        SimpleExcelReader::create($this->import)->getRows()
            ->each(function (array $rowProperties) {

                $this->company = Company::where('code', $rowProperties['company_code'])->first();

                if (! $this->company) {
                    return;
                }

                $this->companyId = $this->company->id;
                $this->companyCode = $this->company->code;
                $this->companyName = $this->company->name;

                $this->branch = Branch::where('code', $rowProperties['branch_code'])->first();

                if (! $this->branch) {
                    return;
                }

                $this->branchId = $this->branch->id;
                $this->branchCode = $this->branch->code;
                $this->branchName = $this->branch->name;

                $this->workingCalendar = WorkingCalendar::firstOrNew([
                    'date' => $rowProperties['date'],
                ]);

                $this->workingCalendar->company_id = $this->companyId;
                $this->workingCalendar->company_code = $this->companyCode;
                $this->workingCalendar->company_name = $this->companyName;
                $this->workingCalendar->branch_id = $this->branchId;
                $this->workingCalendar->branch_code = $this->branchCode;
                $this->workingCalendar->branch_name = $this->branchName;
                $this->workingCalendar->type = $rowProperties['type'];
                $this->workingCalendar->description = $rowProperties['description'];
                $this->workingCalendar->created_by = auth()->user()->id;
                $this->workingCalendar->save();
            });

        $this->dispatch('refresh');
    }

    /**
     * Render the component
     */
    public function render(): View
    {
        return view('livewire.import-working-calendar');
    }
}
