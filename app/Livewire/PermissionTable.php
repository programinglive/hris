<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class PermissionTable extends Component
{
    use withPagination;
    public $showForm = false;

    #[Url]
    public $search;

    /**
     * Handles the event when a permission is created.
     *
     * @param int $permissionId The ID of the created permission.
     * @return void
     */
    #[On('permission-created')]
    public function permissionAdded(int $permissionId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a permission is updated.
     *
     * @param int $permissionId The ID of the updated permission.
     * @return void
     */
    #[On('permission-updated')]
    public function permissionUpdated(int $permissionId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a permission is deleted.
     * @return void
     */
    #[On('permission-deleted')]
    public function permissionDeleted(): void
    {
        $this->showForm = false;
        $this->resetPage();
        $this->getPermissions();
    }

    /**
     * Shows the form permission.
     *
     * @return void
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    public function getPermissions()
    {
        return Permission::where('name', 'like', '%' . $this->search . '%')->paginate(5);
    }

    /**
     * Render the livewire component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.permission-table',[
            'permissions' => self::getPermissions()
        ]);
    }
}