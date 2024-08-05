<?php

namespace App\Livewire;

use App\Models\Company;
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

    #[Url(keep:true)]
    public $companyCode = "all";

    #[Url(keep:true)]
    public $branchCode = "all";

    /**
     * Sets the value of the company code property to the given code.
     *
     * @param string $code The code to set as the company code.
     * @return void
     */
    #[On('setCompanyCode')]
    public function setCompanyCode(string $code): void
    {
        $this->companyCode = $code;
    }

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
        $users = User::join('user_details', 'user_details.user_id', '=', 'users.id')
            ->where(function($query){
                $query->where('user_details.code', 'like', '%' . $this->search . '%')
                    ->orWhere('users.name', 'like', '%' . $this->search . '%');
            });

        if($this->companyCode != "all") {
            $users = $users->where('user_details.company_id', Company::where('code', $this->companyCode)->first()->id);
        }

        if($this->branchCode != "all") {
            $users = $users->where('user_details.branch_id', $this->branchCode);
        }

        return $users->orderBy('users.id')
                    ->paginate(5);
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