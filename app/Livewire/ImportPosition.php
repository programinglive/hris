<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;
use App\Models\Division;
use App\Models\Level;
use App\Models\Position;
use App\Models\SubDivision;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportPosition extends Component
{
    use WithFileUploads;

    public $position;

    public $department;

    public $division;

    public $subDivision;

    public $level;

    public $company;

    public $companyCode;

    public $branch;

    public $branchCode;

    public $import;

    /**
     * Import position data from a file.
     */
    public function importPosition(): void
    {
        $this->validate([
            'import' => 'required|mimes:csv,xlsx,xls',
        ]);

        $this->import->store(path: 'positions');

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

                $this->position = Position::firstOrNew([
                    'code' => $rowProperties['code'],
                ]);

                $this->position->company_id = $this->company->id;
                $this->position->company_code = $this->companyCode;
                $this->position->company_name = $this->company->name;

                $this->position->branch_id = $this->branch->id;
                $this->position->branch_code = $this->branchCode;
                $this->position->branch_name = $this->branch->name;

                $this->department = Department::where(
                    'code', $rowProperties['department_code'])
                    ->first();

                if ($this->department) {
                    $this->position->department_id = $this->department->id;
                    $this->position->department_code = $this->department->code;
                    $this->position->department_name = $this->department->name;
                }

                $this->division = Division::where(
                    'code', $rowProperties['division_code'])
                    ->first();

                if ($this->division) {
                    $this->position->division_id = $this->division->id;
                    $this->position->division_code = $this->division->code;
                    $this->position->division_name = $this->division->name;
                }

                $this->subDivision = SubDivision::where(
                    'code', $rowProperties['sub_division_code'])
                    ->first();

                if ($this->subDivision) {
                    $this->position->sub_division_id = $this->subDivision->id;
                    $this->position->sub_division_code = $this->subDivision->code;
                    $this->position->sub_division_name = $this->subDivision->name;
                }

                $this->level = Level::where(
                    'code', $rowProperties['level_code'])
                    ->first();

                if ($this->level) {
                    $this->position->level_id = $this->level->id;
                    $this->position->level_code = $this->level->code;
                    $this->position->level_name = $this->level->name;
                }

                $this->position->code = $rowProperties['code'];
                $this->position->name = $rowProperties['name'];
                $this->position->description = $rowProperties['description'];
                $this->position->save();
            });

        $this->dispatch('refresh');
    }

    public function render(): View
    {
        return view('livewire.import-position');
    }
}
