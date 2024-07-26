<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RoleTable extends Component
{
    use withPagination;
    public $showForm = false;

    #[url]
    public $search;

    /**
     * Handles the event when a role is created.
     *
     * @param int $roleId The ID of the created role.
     * @return void
     */
    #[on('role-created')]
    public function roleAdded(int $roleId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a role is updated.
     *
     * @param int $roleId The ID of the updated role.
     * @return void
     */
    #[on('role-updated')]
    public function roleUpdated(int $roleId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a role is deleted.
     * @return void
     */
    #[on('role-deleted')]
    public function roleDeleted(): void
    {
        $this->showForm = false;
        $this->resetPage();
        $this->getRoles();
    }

    /**
     * Shows the form role.
     *
     * @return void
     */
    #[on('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    public function getRoles()
    {
        return Role::where('code', 'like', '%' . $this->search . '%')->paginate(5);
    }

    /**
     * Render the livewire component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.role-table',[
            'roles' => self::getRoles()
        ]);
    }
}