<?php

namespace App\Livewire;

use DB;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleForm extends Component
{

    #[validate('required|unique:roles|min:3')]
    public $name;

    public $role;

    public $actionForm = 'save';

    /**
     * Updates the specified property with the given value and performs validation if the property is 'code',
     * 'email', or 'phone'.
     *
     * @param string $key The name of the property to be updated.
     * @param mixed $value The new value for the property.
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
     * The default data for the form.
     *
     * @return array
     */
    public function roleData(): array
    {
        return [
            'name' => $this->name,
        ];
    }

    /**
     * Saves the role details to the database and dispatches a 'role-created' event.
     *
     * @return void
     */
    public function save(): void
    {
        $this->validate();

        DB::transaction(function () {
            $this->role = Role::create($this->roleData());
        }, 5);

        $this->dispatch('role-created', roleId: $this->role->id);

        $this->reset();
    }

    /**
     * Edit the role details.
     */
    #[on('edit')]
    public function edit($name): void
    {
        $this->role = Role::where('name',$name)->first();
        $this->name = $this->role->name;

        $this->actionForm = 'update';

        $this->dispatch('show-form');
    }

    /**
     * Updates the role details in the database.
     */
    public function update(): void
    {
        DB::transaction(function () {
            $this->role->update($this->roleData());
        }, 5);

        $this->dispatch('role-updated', roleId: $this->role->id);

        $this->reset();
    }

    /**
     * Deletes the role from the database.
     */
    #[on('delete')]
    public function destroy($name): void
    {
        $this->role = Role::where('name',$name)->first();
        $this->role->delete();

        $this->dispatch('role-deleted', refreshCompanies: true);
    }

    /**
     * Render the livewire component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.role-form');
    }
}