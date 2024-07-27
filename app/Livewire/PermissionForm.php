<?php

namespace App\Livewire;

use DB;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PermissionForm extends Component
{

    #[Validate('required|unique:permissions|min:3')]
    public $name;

    public $permission;

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
    public function permissionData(): array
    {
        return [
            'name' => $this->name,
        ];
    }

    /**
     * Saves the permission details to the database and dispatches a 'permission-created' event.
     *
     * @return void
     */
    public function save(): void
    {
        $this->validate();

        DB::transaction(function () {
            $this->permission = Permission::create($this->permissionData());
        }, 5);

        $this->dispatch('permission-created', permissionId: $this->permission->id);

        $this->reset();
    }

    /**
     * Edit the permission details.
     */
    #[On('edit')]
    public function edit($name): void
    {
        $this->permission = Permission::where('name',$name)->first();
        $this->name = $this->permission->name;

        $this->actionForm = 'update';

        $this->dispatch('show-form');
    }

    /**
     * Updates the permission details in the database.
     */
    public function update(): void
    {
        DB::transaction(function () {
            $this->permission->update($this->permissionData());
        }, 5);

        $this->dispatch('permission-updated', permissionId: $this->permission->id);

        $this->reset();
    }

    /**
     * Deletes the permission from the database.
     */
    #[On('delete')]
    public function destroy($name): void
    {
        $this->permission = Permission::where('name',$name)->first();
        $this->permission->delete();

        $this->dispatch('permission-deleted', refreshCompanies: true);
    }

    /**
     * Render the livewire component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.permission-form');
    }
}