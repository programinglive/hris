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

    public function importWorkingCalendar(): void
    {
        $this->validate([
            'import' => 'required|mimes:csv,xlsx,xls',
        ]);

        $this->import->store(path: 'workingCalendars');

        $this->import = $this->import->path();

        SimpleExcelReader::create($this->import)->getRows()
            ->each(function (array $rowProperties) {

                $company = Company::where('code', $rowProperties['comp_code'])->first();

                if (! $company) {
                    return;
                }

                $branch = Branch::where('code', $rowProperties['branch_code'])->first();

                if (! $branch) {
                    return;
                }

                WorkingCalendar::create([
                    'company_id' => $company->id,
                    'company_code' => $company->code,
                    'company_name' => $company->name,
                    'branch_id' => $branch->id,
                    'branch_code' => $branch->code,
                    'branch_name' => $branch->name,
                    'date' => $rowProperties['date'],
                    'type' => $rowProperties['type'],
                    'description' => $rowProperties['description'],
                ]);
            });

        $this->dispatch('refresh');
    }

    public function render(): View
    {
        return view('livewire.import-working-calendar');
    }
}
