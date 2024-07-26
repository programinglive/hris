<?php

namespace App\Livewire;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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

    #[Url]
    public $search;

    /**
     * Handles the event when a role is created.
     *
     * @param int $roleId The ID of the created role.
     * @return void
     */
    #[On('role-created')]
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
    #[On('role-updated')]
    public function roleUpdated(int $roleId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a role is deleted.
     * @return void
     */
    #[On('role-deleted')]
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
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Retrieves a paginated list of roles based on a search query.
     *
     * @return LengthAwarePaginator The paginated list of roles.
     */
    public function getRoles(): LengthAwarePaginator
    {
        return Role::where('name', 'like', '%' . $this->search . '%')->paginate(5);
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