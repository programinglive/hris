<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;
use App\Models\Division;
use App\Models\Level;
use App\Models\Position;
use App\Models\SubDivision;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportUser extends Component
{
    use WithFileUploads;

    public $import;

    public $company;

    public $companyCode;

    public $branch;

    public $branchCode;

    public $department;

    public $departmentCode;

    public $division;

    public $divisionCode;

    public $subDivision;

    public $subDivisionCode;

    public $level;

    public $levelCode;

    public $position;

    public $positionCode;

    /**
     * Handles the event when the import field is updated.
     *
     * This function will validate the uploaded file and store it in the
     * 'photos' directory.
     * The path of the uploaded file will be stored in
     * the $this→import variable.
     */
    public function importUser(): void
    {
        // check if a company exists
        $company = Company::first();

        if (! $company) {
            $this->addError('errorMessage', 'Company not found');

            return;
        }

        // check if a branch exists
        $branch = Branch::first();

        if (! $branch) {
            $this->addError('errorMessage', 'Branch not found');

            return;
        }

        $this->validate([
            'import' => 'required|mimes:csv,xlsx,xls',
        ]);

        $this->import->store(path: 'users');

        $this->import = $this->import->path();

        SimpleExcelReader::create($this->import)->getRows()
            ->each(function (array $rowProperties) {

                $userUpdated = User::where('name', $rowProperties['name'])
                    ->whereDate('updated_at', today())->first();

                if ($userUpdated) {
                    return;
                }

                $this->company = Company::where('code', $rowProperties['company_code'])->first();

                $this->branch = Branch::where('code', $rowProperties['branch_code'])->first();

                $this->department = Department::where('code', $rowProperties['department_code'])->first();

                $this->division = Division::where('code', $rowProperties['division_code'])->first();

                $this->subDivision = SubDivision::where('code', $rowProperties['sub_division_code'])->first();

                $this->level = Level::where('code', $rowProperties['level_code'])->first();

                $this->position = Position::where('code', $rowProperties['position_code'])->first();

                if ($rowProperties['email'] == '') {
                    $rowProperties['email'] = time().'@test.com';
                }

                $user = User::firstOrNew([
                    'name' => $rowProperties['name'],
                ]);

                $user->password = bcrypt('hris123');
                $user->email = $rowProperties['email'] == '' ? time().'@test.com' : $rowProperties['name'].'@test.com';
                $user->save();

                $userDetail = UserDetail::firstOrNew([
                    'user_id' => $user->id,
                ]);

                $userDetail->company_id = $this->company?->id;
                $userDetail->branch_id = $this->branch?->id;
                $userDetail->department_id = $this->department?->id;
                $userDetail->division_id = $this->division?->id;
                $userDetail->sub_division_id = $this->subDivision?->id;
                $userDetail->level_id = $this->level?->id;
                $userDetail->position_id = $this->position?->id;
                $userDetail->company_code = $rowProperties['company_code'];
                $userDetail->company_name = $this->company?->name;
                $userDetail->branch_code = $rowProperties['branch_code'];
                $userDetail->branch_name = $this->branch?->name;
                $userDetail->department_code = $rowProperties['department_code'];
                $userDetail->department_name = $this->department?->name;
                $userDetail->division_code = $rowProperties['division_code'];
                $userDetail->division_name = $this->division?->name;
                $userDetail->sub_division_code = $rowProperties['sub_division_code'];
                $userDetail->sub_division_name = $this->subDivision?->name;
                $userDetail->level_code = $rowProperties['level_code'];
                $userDetail->level_name = $this->level?->name;
                $userDetail->position_code = $rowProperties['position_code'];
                $userDetail->position_name = $this->position?->name;
                $userDetail->nik = $rowProperties['nik'];
                $userDetail->first_name = $rowProperties['first_name'];
                $userDetail->last_name = $rowProperties['last_name'];
                $userDetail->date_in = $rowProperties['date_in'] == '' ? null : $rowProperties['date_in'];
                $userDetail->date_out = $rowProperties['date_out'] == '' ? null : $rowProperties['date_out'];
                $userDetail->save();

            });

        $this->dispatch('refresh');
    }

    public function render(): View
    {
        return view('livewire.import-user');
    }
}
