<?php

namespace App\Livewire;

use App\Models\UserDetail;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeTable extends Component
{
    use withPagination;

    public $showForm = false;

    #[Url(keep: true)]
    public $filterCompanyCode;

    #[Url(keep: true)]
    public $filterBranchCode;

    #[Url(keep: true)]
    public $search;

    #[On('filter-company')]
    public function filterCompany($companyCode): void
    {
        $this->filterBranchCode = '';
        $this->filterCompanyCode = $companyCode;
    }

    #[On('filter-branch')]
    public function filterBranch($branchCode): void
    {
        $this->filterBranchCode = $branchCode;
    }

    /**
     * Shows the form employee.
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Hides the form employee.
     */
    #[On('hide-form')]
    public function hideForm(): void
    {
        $this->showForm = false;
    }

    #[On('refresh')]
    public function refresh() {}

    /**
     * Retrieves a paginated list of employees based on a search query.
     *
     * @return LengthAwarePaginator The paginated list of employees.
     */
    public function getEmployees(): LengthAwarePaginator
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
        return view('livewire.employee-table', [
            'employees' => self::getEmployees(),
        ]);
    }
}