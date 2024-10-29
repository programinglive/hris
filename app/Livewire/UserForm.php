<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;
use App\Models\Division;
use App\Models\Level;
use App\Models\Position;
use App\Models\User;
use App\Models\UserDetail;
use DB;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UserForm extends Component
{
    public $company;

    #[Url(keep: true)]
    public $companyCode;

    public $companyName;

    public $branch;

    #[Url('branchCode', keep: true)]
    public $branchCode;

    #[Validate('required|unique:users|regex:/^\S+$/')]
    public $name;

    #[Validate('required|email|unique:users')]
    public $email;

    public $password;

    public $password_confirmation;

    public $newPassword = false;

    public $details = [
        'department_id' => null,
        'division_id' => null,
        'sub_division_id' => null,
        'position_id' => null,
        'level_id' => null,
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

    public $user;

    public $actionForm = 'save';

    /**
     * Mount the component
     */
    public function mount(): void
    {
        if ($this->companyCode != '') {
            $this->company = Company::where('code', $this->companyCode)->first();
        }

        if ($this->branchCode != '') {
            $this->branch = Branch::where('code', $this->branchCode)->first();
        }
    }

    #[On('set-detail')]
    public function setDetail($details): void
    {
        foreach ($details as $key => $value) {
            $this->details[$key] = $value;
        }
    }

    /**
     * Set the department ID for the details.
     *
     * @param  string  $departmentCode  The ID of the department.
     */
    #[On('set-department')]
    public function setDepartment(string $departmentCode): void
    {
        if ($departmentCode != '') {
            $department = Department::where('code', $departmentCode)->first();
            $this->details['department_id'] = $department->id;
        }
    }

    /**
     * Set the division ID for the details.
     *
     * @param  int  $divisionCode  The ID of the division.
     */
    #[On('setDivision')]
    public function setDivision(int $divisionCode): void
    {
        if ($divisionCode != 0) {
            $division = Division::where('code', $divisionCode)->first();

            if (! $division) {
                $this->dispatch('setErrorDivision');

                return;
            }

            $this->details['division_id'] = $division->code;
        }
    }

    /**
     * Set the level ID for the details.
     *
     * @param  string  $levelCode  The ID of the level.
     */
    #[On('set-level')]
    public function setLevel(string $levelCode): void
    {
        if ($levelCode != 0) {
            $level = Level::where('code', $levelCode)->first();

            if (! $level) {
                $this->dispatch('setErrorLevel');

                return;
            }

            $this->details['level_id'] = $level->id;
        }
    }

    /**
     * Set the position ID for the details.
     *
     * @param  int  $positionCode  The ID of the position.
     */
    #[On('setPosition')]
    public function setPosition(int $positionCode): void
    {
        if ($positionCode != 0) {
            $position = Position::where('code', $positionCode)->first();

            if (! $position) {
                $this->dispatch('setErrorPosition');

                return;
            }

            $this->details['position_id'] = $position->id;
        }
    }

    /**
     * The default data for the form.
     */
    public function userData(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password ?? 'beautyworld',
        ];
    }

    /**
     * Returns an array containing the company ID, branch ID, and user ID of the given user.
     *
     * @param  User  $user  The user object to retrieve the details from.
     * @return array An array with keys 'company_id', 'branch_id', and 'user_id', each containing the respective ID.
     */
    public function userDetailData(User $user): array
    {
        return [
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'company_code' => $this->company->code,
            'company_name' => $this->company->name,
            'branch_code' => $this->branch->code,
            'branch_name' => $this->branch->name,
            'user_id' => $this->user->id,
            'department_id' => $this->details['department_id'],
            'division_id' => $this->details['division_id'],
            'sub_division_id' => $this->details['sub_division_id'],
            'position_id' => $this->details['position_id'],
            'level_id' => $this->details['level_id'],
            'nik' => $this->details['nik'],
            'first_name' => $this->details['first_name'],
            'last_name' => $this->details['last_name'],
            'phone' => $this->details['phone'],
            'address' => $this->details['address'],
            'gender' => $this->details['gender'],
            'religion' => $this->details['religion'],
            'last_education' => $this->details['last_education'],
            'marriage_status' => $this->details['marriage_status'],
            'place_of_birth' => $this->details['place_of_birth'],
            'date_of_birth' => $this->details['date_of_birth'],
            'ktp' => $this->details['ktp'],
            'npwp' => $this->details['npwp'],
            'bank_account' => $this->details['bank_account'],
            'date_in' => $this->details['date_in'],
            'date_out' => $this->details['date_out'],
            'note' => $this->details['note'],
        ];
    }

    /**
     * Saves the user details to the database and dispatches a 'user-created' event.
     */
    public function save(): void
    {
        if (! $this->company) {
            $this->addError('errorMessage', 'Please Select Company First');

            return;
        }

        if (! $this->branch) {
            $this->addError('errorMessage', 'Please Select Branch First');

            return;
        }

        $this->validate();

        DB::transaction(function () {
            $this->user = User::create(self::userData());
            UserDetail::create(self::UserDetailData($this->user));
        }, 5);

        $this->dispatch('hide-form');
        $this->dispatch('refresh');

    }

    /**
     * Edit the user details.
     */
    #[On('edit')]
    public function edit($name): void
    {
        $this->user = User::where('name', $name)->first();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->details = $this->user->details;

        $this->actionForm = 'update';

        if (! is_null($this->user->details->company_id)) {
            $this->dispatch('selectCompany', $this->user->details->company_id);
        }

        $this->dispatch('disableFilter');
        $this->dispatch('show-form');
    }

    /**
     * Updates the user details in the database.
     */
    public function update(): void
    {
        DB::transaction(function () {
            $userData = $this->userData();
            unset($userData['password']);
            if ($this->newPassword) {
                $this->validateOnly('password_confirmation');
                $userData['password'] = bcrypt($this->password);
            }

            $this->user->update($userData);
        }, 5);

        $this->dispatch('user-updated', userId: $this->user->id);

        $this->reset();
    }

    /**
     * Deletes the user from the database.
     */
    #[On('delete')]
    public function destroy($name): void
    {
        $this->user = User::where('name', $name)->first();
        $this->user->delete();

        $this->dispatch('user-deleted', refreshCompanies: true);
    }

    #[On('clearUserForm')]
    public function clearUserForm(): void
    {
        $this->resetErrorBag();
        $this->reset();

        $this->dispatch('hide-form');
    }

    #[On('resetError')]
    public function resetError(): void
    {
        $this->resetErrorBag();
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.user-form');
    }
}
