<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;
use App\Models\Division;
use App\Models\SubDivision;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportSubDivision extends Component
{
    use WithFileUploads;

    public $subDivision;

    public $division;

    public $department;

    public $company;

    public $branch;

    public $import;

    /**
     * Import division data from file.
     */
    public function importSubDivision(): void
    {
        $this->validate([
            'import' => 'required|mimes:csv,xlsx,xls',
        ]);

        $this->import->store(path: 'subDivisions');

        $this->import = $this->import->path();

        SimpleExcelReader::create($this->import)->getRows()
            ->each(function (array $rowProperties) {

                $this->company = Company::where('code', $rowProperties['company_code'])->first();

                if (! $this->company) {
                    return;
                }

                $this->branch = Branch::where('code', $rowProperties['branch_code'])->first();

                if (! $this->branch) {
                    return;
                }

                $this->subDivision = SubDivision::firstOrNew([
                    'code' => $rowProperties['code'],
                ]);

                $this->subDivision->company_id = $this->company->id;
                $this->subDivision->company_code = $this->company->code;
                $this->subDivision->company_name = $this->company->name;

                $this->subDivision->branch_id = $this->branch->id;
                $this->subDivision->branch_code = $this->branch->code;
                $this->subDivision->branch_name = $this->branch->name;

                $this->department = Department::where(
                    'code', $rowProperties['department_code'])
                    ->first();

                if ($this->department) {
                    $this->subDivision->department_id = $this->department->id;
                    $this->subDivision->department_code = $this->department->code;
                    $this->subDivision->department_name = $this->department->name;
                }

                $this->division = Division::where(
                    'code', $rowProperties['division_code'])
                    ->first();

                if ($this->division) {
                    $this->subDivision->division_id = $this->division->id;
                    $this->subDivision->division_code = $this->division->code;
                    $this->subDivision->division_name = $this->division->name;
                }

                $this->subDivision->code = $rowProperties['code'];
                $this->subDivision->name = $rowProperties['name'];
                $this->subDivision->description = $rowProperties['description'];
                $this->subDivision->save();
            });

        $this->dispatch('refresh');
    }

    public function render(): View
    {
        return view('livewire.import-sub-division');
    }
}
