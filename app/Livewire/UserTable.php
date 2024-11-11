<?php

namespace App\Livewire;

use App\Models\UserDetail;
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

    #[On('filter-company')]
    public function filterCompany($companyCode): void
    {
        $this->filterCompanyCode = $companyCode;
        $this->companyCode = $companyCode;
    }

    #[On('filter-branch')]
    public function filterBranch($branchCode): void
    {
        $this->filterBranchCode = $branchCode;
        $this->branchCode = $branchCode;
    }

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
        $this->dispatch('clear-form');
        $this->showForm = false;
    }

    #[On('show-profile')]
    public function showProfile(): void
    {
        $this->redirect(route('profile'));
    }

    #[On('refresh')]
    public function refresh(): void
    {
        $this->resetPage();
    }

    /**
     * Retrieves a paginated list of users based on the search criteria.
     *
     * @return LengthAwarePaginator The paginated list of users.
     */
    public function getUsers(): LengthAwarePaginator
    {
        $users = UserDetail::where(function ($query) {
            $query->where('user_details.nik', 'like', '%'.$this->search.'%')
                ->orWhere('user_details.first_name', 'like', '%'.$this->search.'%')
                ->orWhere('user_details.last_name', 'like', '%'.$this->search.'%')
                ->orWhere('user_details.phone', 'like', '%'.$this->search.'%');
        })
            ->where('user_details.first_name', '!=', 'admin')
            ->orderBy('user_details.nik', 'desc');

        if ($this->filterCompanyCode) {
            $users->where('user_details.company_code', $this->filterCompanyCode);
        }

        if ($this->filterBranchCode) {
            $users->where('user_details.branch_code', $this->filterBranchCode);
        }

        return $users->paginate(10);
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
