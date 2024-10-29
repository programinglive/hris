<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;
use App\Models\Division;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportDivision extends Component
{
    use WithFileUploads;

    public $division;

    public $department;

    public $company;

    public $companyCode;

    public $branch;

    public $branchCode;

    public $import;

    /**
     * Import division data from file.
     */
    public function importDivision(): void
    {
        $this->validate([
            'import' => 'required|mimes:csv,xlsx,xls',
        ]);

        $this->import->store(path: 'divisions');

        $this->import = $this->import->path();

        SimpleExcelReader::create($this->import)->getRows()
            ->each(function (array $rowProperties) {

                $this->company = Company::where('code', $rowProperties['company_code'])->first();

                if (! $this->company) {
                    return;
                }

                $this->companyCode = $this->company->code;

                $this->branch = Branch::where('code', $rowProperties['branch_code'])->first();

                if (! $this->branch) {
                    return;
                }

                $this->branchCode = $this->branch->code;

                $this->division = Division::firstOrNew([
                    'code' => $rowProperties['code'],
                ]);

                $this->division->company_id = $this->company->id;
                $this->division->company_code = $this->companyCode;
                $this->division->company_name = $this->company->name;

                $this->division->branch_id = $this->branch->id;
                $this->division->branch_code = $this->branchCode;
                $this->division->branch_name = $this->branch->name;

                $this->department = Department::where(
                    'code', $rowProperties['department_code'])
                    ->first();

                if ($this->department) {
                    $this->division->department_id = $this->department->id;
                    $this->division->department_code = $this->department->code;
                    $this->division->department_name = $this->department->name;
                }

                $this->division->code = $rowProperties['code'];
                $this->division->name = $rowProperties['name'];
                $this->division->description = $rowProperties['description'];
                $this->division->save();
            });

        $this->dispatch('refresh');
    }

    public function render(): View
    {
        return view('livewire.import-division');
    }
}
