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
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class UserDetailForm extends Component
{
    public $company;

    #[Url(keep: true)]
    public $companyCode;

    public $branch;

    #[Url(keep: true)]
    public $branchCode;

    public $department;

    #[Url(keep: true)]
    public $departmentCode;

    public $division;

    #[Url(keep: true)]
    public $divisionCode;

    public $subDivision;

    #[Url(keep: true)]
    public $subDivisionCode;

    public $level;

    #[Url(keep: true)]
    public $levelCode;

    public $position;

    #[Url(keep: true)]
    public $positionCode;

    public $user;

    public $userDetail;

    #[Url(keep: true)]
    public $nik;

    public $details = [
        'company_id' => null,
        'branch_id' => null,
        'department_id' => null,
        'division_id' => null,
        'sub_division_id' => null,
        'level_id' => null,
        'position_id' => null,
        'company_code' => null,
        'company_name' => null,
        'branch_code' => null,
        'branch_name' => null,
        'department_code' => null,
        'department_name' => null,
        'division_code' => null,
        'division_name' => null,
        'sub_division_code' => null,
        'sub_division_name' => null,
        'level_code' => null,
        'level_name' => null,
        'position_code' => null,
        'position_name' => null,
        'nik' => null,
        'first_name' => null,
        'last_name' => null,
        'phone' => null,
        'address' => null,
        'gender' => null,
        'religion' => null,
        'last_education' => null,
        'marriage_status' => null,
        'place_of_birth' => null,
        'date_of_birth' => null,
        'ktp' => null,
        'npwp' => null,
        'bank_account' => null,
        'date_in' => null,
        'date_out' => null,
        'note' => null,
    ];

    public function mount(): void
    {
        if($this->nik != '') {
            $this->setUser();
        }
    }

    /**
     * @return void
     */
    public function setUser(): void
    {
        $this->userDetail = UserDetail::where('nik', $this->nik)->first();
        $this->user = $this->userDetail->user;

        $this->details = $this->userDetail->toArray();
    }

    #[On('set-detail')]
    public function setDetail($details): void
    {
        $this->details = $details;
    }

    #[On('set-company')]
    public function setCompany($companyCode): void
    {
        $this->details['company_code'] = $companyCode;
        $this->company = Company::where('code', $companyCode)->first();
        $this->details['company_name'] = $this->company->name;
    }

    #[On('set-branch')]
    public function setBranch($branchCode): void
    {
        $this->details['branch_code'] = $branchCode;
        $this->branch = Branch::where('code', $branchCode)->first();
        $this->details['branch_name'] = $this->branch->name;
    }

    #[On('set-department')]
    public function setDepartment($departmentCode): void
    {
        $this->details['department_code'] = $departmentCode;
        $this->department = Department::where('code', $departmentCode)->first();
        $this->details['department_name'] = $this->department->name;
    }

    #[On('set-division')]
    public function setDivision($divisionCode): void
    {
        $this->details['division_code'] = $divisionCode;
        $this->division = Division::where('code', $divisionCode)->first();
        $this->details['division_name'] = $this->division->name;
    }

    #[On('set-sub-division')]
    public function setSubDivision($subDivisionCode): void
    {
        $this->details['sub_division_code'] = $subDivisionCode;
        $this->subDivision = SubDivision::where('code', $subDivisionCode)->first();
        $this->details['sub_division_name'] = $this->subDivision->name;
    }

    #[On('set-level')]
    public function setLevel($levelCode): void
    {
        $this->details['level_code'] = $levelCode;
        $this->level = Level::where('code', $levelCode)->first();
        $this->details['level_name'] = $this->level->name;
    }

    #[On('set-position')]
    public function setPosition($positionCode): void
    {
        $this->details['position_code'] = $positionCode;
        $this->position = Position::where('code', $positionCode)->first();
        $this->details['position_name'] = $this->position->name;
    }

    /**
     * Listen to the Livewire property change event and update the $details array.
     */
    public function updated(string $key, mixed $value): void
    {
        $keyArray = explode('.', $key);
        $this->details[$keyArray[1]] = $value;

        $this->dispatch('set-detail', $this->details);
    }

    public function render(): View
    {
        return view('livewire.user-detail-form');
    }
}