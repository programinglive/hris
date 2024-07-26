<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class UserTable extends Component
{
    use withPagination;
    public $showForm = false;

    #[Url]
    public $search;

    /**
     * Handles the event when a user is created.
     *
     * @param int $userId The ID of the created user.
     * @return void
     */
    #[On('user-created')]
    public function userAdded(int $userId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a user is updated.
     *
     * @param int $userId The ID of the updated user.
     * @return void
     */
    #[On('user-updated')]
    public function userUpdated(int $userId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a user is deleted.
     * @return void
     */
    #[On('user-deleted')]
    public function userDeleted(): void
    {
        $this->showForm = false;
        $this->resetPage();
        $this->getUsers();
    }

    /**
     * Shows the form user.
     *
     * @return void
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Retrieves a paginated list of users based on the search criteria.
     *
     * @return LengthAwarePaginator The paginated list of users.
     */
    public function getUsers(): LengthAwarePaginator
    {
        return User::where('name', 'like', '%' . $this->search . '%')->paginate(5);
    }

    /**
     * Render the livewire component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.user-table',[
            'users' => self::getUsers()
        ]);
    }
}