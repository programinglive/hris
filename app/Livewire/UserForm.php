<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Division;
use App\Models\Level;
use App\Models\Position;
use App\Models\User;
use App\Models\UserDetail;
use DB;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UserForm extends Component
{

    #[Validate('required|unique:users|regex:/^\S+$/')]
    public $name;

    #[Validate('required|email|unique:users')]
    public $email;

    public $password;

    #[Validate('same:password')]
    public $password_confirmation;

    public $newPassword = false;

    public $user;

    public $details = [
        'company_id',
        'branch_id',
        'department_id',
        'level_id',
        'position_id',
        'first_name',
        'last_name',
        'phone',
        'address',
        'gender',
        'religion',
        'last_education',
        'marriage_status',
        'place_of_birth',
        'date_of_birth',
        'ktp',
        'npwp',
        'bank_account',
    ];

    public $actionForm = 'save';

    /**
     * 
     *
     * @param string $key
     * @param mixed $value
     * @return void
     * @throws ValidationException
     */
    public function updated(string $key, mixed $value): void
    {
        if($key == 'name'){
            $this->validateOnly($key);
        }
    }

    /**
     * Set the department ID for the details.
     *
     * @param string $departmentCode The ID of the department.
     * @return void
     */
    #[On('setDepartment')]
    public function setDepartment(string $departmentCode): void
    {
        if($departmentCode != 0){
            $department = Department::where('code', $departmentCode)->first();
            if(!$department){
                $this->dispatch('setErrorDepartment');
                return;
            }
            $this->details['department_id'] = $department->id;
        }
    }

    /**
     * Set the division ID for the details.
     *
     * @param int $divisionCode The ID of the division.
     * @return void
     */
    #[On('setDivision')]
    public function setDivision(int $divisionCode): void
    {
        if($divisionCode != 0){
            $division = Division::where('code', $divisionCode)->first();

            if(!$division){
                $this->dispatch('setErrorDivision');
                return;
            }

            $this->details['division_id'] = $division->code;
        }
    }

    /**
     * Set the level ID for the details.
     *
     * @param string $levelCode The ID of the level.
     * @return void
     */
    #[On('setLevel')]
    public function setLevel(string $levelCode): void
    {
        if($levelCode != 0){
            $level = Level::where('code', $levelCode)->first();

            if(!$level){
                $this->dispatch('setErrorLevel');
                return;
            }

            $this->details['level_id'] = $level->id;
        }
    }

    /**
     * Set the position ID for the details.
     *
     * @param int $positionCode The ID of the position.
     * @return void
     */
    #[On('setPosition')]
    public function setPosition(int $positionCode): void
    {
        if($positionCode != 0){
            $position = Position::where('code', $positionCode)->first();

            if(!$position){
                $this->dispatch('setErrorPosition');
                return;
            }

            $this->details['position_id'] = $position->id;
        }
    }

    /**
     * The default data for the form.
     *
     * @return array
     */
    public function userData(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
        ];
    }

    /**
     * Returns an array containing the company ID, branch ID, and user ID of the given user.
     *
     * @param User $user The user object to retrieve the details from.
     * @return array An array with keys 'company_id', 'branch_id', and 'user_id', each containing the respective ID.
     */
    public function userDetailData(User $user): array
    {
        return [
            'company_id' => $this->companyId,
            'branch_id' => $this->branchId,
            'user_id' => $this->user->id
        ];
    }

    /**
     * Saves the user details to the database and dispatches a 'user-created' event.
     *
     * @return void
     */
    public function save(): void
    {
        $this->validate();

        DB::transaction(function () {
            $this->user = User::create(self::userData());
            UserDetail::create(self::UserDetailData($this->user));
        }, 5);

        $this->dispatch('user-created', userId: $this->user->id);

        $this->reset();
    }

    /**
     * Edit the user details.
     */
    #[On('edit')]
    public function edit($name): void
    {
        $this->user = User::where('name',$name)->first();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->details = $this->user->details;
        
        $this->actionForm = 'update';

        $this->dispatch('selectCompany', $this->user->details->company_id);
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
        $this->user = User::where('name',$name)->first();
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

    /**
     * Render the livewire component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.user-form');
    }
}