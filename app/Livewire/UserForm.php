<?php

namespace App\Livewire;

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

        if($key == 'password'){
            $this->newPassword = true;
        }
    }

    /**
     * Set the department ID for the details.
     *
     * @param int $departmentId The ID of the department.
     * @return void
     */
    #[On('setDepartment')]
    public function setDepartment(int $departmentId): void
    {
        if($departmentId != 0){
            $this->details['department_id'] = $departmentId;
        }
    }

    /**
     * Set the division ID for the details.
     *
     * @param int $divisionId The ID of the division.
     * @return void
     */
    #[On('setDivision')]
    public function setDivision(int $divisionId): void
    {
        if($divisionId != 0){
            $this->details['division_id'] = $divisionId;
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
            'password' => $this->password,
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
            $this->user = User::create($this->userData());
            UserDetail::create([
                'company_id' => auth()->user()->details->company_id,
                'branch_id' => auth()->user()->details->branch_id,
                'user_id' => $this->user->id
            ]);
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