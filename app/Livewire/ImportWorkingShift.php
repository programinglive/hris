<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Company;
use App\Models\WorkingShift;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportWorkingShift extends Component
{
    use WithFileUploads;

    public $company;

    public $companyId;

    public $companyCode;

    public $companyName;

    public $branch;

    public $branchId;

    public $branchCode;

    public $branchName;

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

                $this->company = Company::where('code', $rowProperties['comp_code'])->first();

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

                WorkingShift::create([
                    'company_id' => $this->companyId,
                    'branch_id' => $this->branchId,
                    'name' => $rowProperties['name'],
                    'start_time' => $rowProperties['start_time'],
                    'end_time' => $rowProperties['end_time'],
                    'description' => $rowProperties['description'],
                    'company_code' => $this->companyCode,
                    'company_name' => $this->companyName,
                    'branch_code' => $this->branchCode,
                    'branch_name' => $this->branchName,
                ]);
            });

        $this->dispatch('refresh');
    }

    public function render(): View
    {
        return view('livewire.import-working-shift');
    }
}
