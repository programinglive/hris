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

    #[Url(keep: true)]
    public $filterCompanyCode;

    #[Url(keep: true)]
    public $companyCode;

    #[Url(keep: true)]
    public $filterBranchCode;

    #[Url(keep: true)]
    public $branchCode;

    public $employee;

    /**
     * Shows the form user.
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Hide the form user.
     */
    #[On('hide-form')]
    public function hideForm(): void
    {
        $this->showForm = false;
    }

    #[On('refresh')]
    public function refresh() {}

    /**
     * Retrieves a paginated list of users based on the search criteria.
     *
     * @return LengthAwarePaginator The paginated list of users.
     */
    public function getUsers(): LengthAwarePaginator
    {
        $users = User::join(
            'user_details',
            'user_details.user_id',
            '=', 'users.id'
        )
            ->where(function ($query) {
                $query->where('user_details.nik', 'like', '%'.$this->search.'%')
                    ->orWhere('users.name', 'like', '%'.$this->search.'%');
            })
            ->where(function ($query) {
                $query->whereNot('users.name', 'like', 'admin');
            });

        if ($this->filterCompanyCode != '') {
            $users->where(function ($query) {
                $query->where('user_details.company_code', $this->filterCompanyCode);
            });
        }

        if ($this->filterBranchCode != '') {
            $users->where(function ($query) {
                $query->where('user_details.branch_code', $this->filterBranchCode);
            });
        }

        return $users->orderBy('users.id')
            ->paginate(10);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.user-table', [
            'users' => self::getUsers(),
        ]);
    }
}
