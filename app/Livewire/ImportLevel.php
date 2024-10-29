<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;
use App\Models\Division;
use App\Models\Level;
use App\Models\SubDivision;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportLevel extends Component
{
    use WithFileUploads;

    public $level;

    public $department;

    public $division;

    public $subDivision;

    public $company;

    public $companyCode;

    public $branch;

    public $branchCode;

    public $import;

    /**
     * Import level data from a file.
     */
    public function importLevel(): void
    {
        $this->validate([
            'import' => 'required|mimes:csv,xlsx,xls',
        ]);

        $this->import->store(path: 'levels');

        $this->import = $this->import->path();

        SimpleExcelReader::create($this->import)->getRows()
            ->each(function (array $rowProperties) {

                $this->company = Company::where(
                    'code',
                    $rowProperties['company_code']
                )->first();

                if (! $this->company) {
                    return;
                }

                $this->companyCode = $this->company->code;

                $this->branch = Branch::where(
                    'code',
                    $rowProperties['branch_code']
                )->first();

                if (! $this->branch) {
                    return;
                }

                $this->branchCode = $this->branch->code;

                $this->level = Level::firstOrNew([
                    'code' => $rowProperties['code'],
                ]);

                $this->level->company_id = $this->company->id;
                $this->level->company_code = $this->companyCode;
                $this->level->company_name = $this->company->name;

                $this->level->branch_id = $this->branch->id;
                $this->level->branch_code = $this->branchCode;
                $this->level->branch_name = $this->branch->name;

                $this->department = Department::where(
                    'code', $rowProperties['department_code'])
                    ->first();

                if ($this->department) {
                    $this->level->department_id = $this->department->id;
                    $this->level->department_code = $this->department->code;
                    $this->level->department_name = $this->department->name;
                }

                $this->division = Division::where(
                    'code', $rowProperties['division_code'])
                    ->first();

                if ($this->division) {
                    $this->level->division_id = $this->division->id;
                    $this->level->division_code = $this->division->code;
                    $this->level->division_name = $this->division->name;
                }

                $this->subDivision = SubDivision::where(
                    'code', $rowProperties['sub_division_code'])
                    ->first();

                if ($this->subDivision) {
                    $this->level->sub_division_id = $this->subDivision->id;
                    $this->level->sub_division_code = $this->subDivision->code;
                    $this->level->sub_division_name = $this->subDivision->name;
                }

                $this->level->code = $rowProperties['code'];
                $this->level->name = $rowProperties['name'];
                $this->level->description = $rowProperties['description'];
                $this->level->save();
            });

        $this->dispatch('refresh');
    }

    public function render(): View
    {
        return view('livewire.import-level');
    }
}
