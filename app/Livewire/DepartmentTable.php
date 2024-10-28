<?php

namespace App\Livewire;

use App\Models\Department;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class DepartmentTable extends Component
{
    use withPagination;

    public $showForm = false;

    public $company;

    #[Url(keep: true)]
    public $filterCompanyCode;

    public $branch;

    #[Url(keep: true)]
    public $filterBranchCode;

    #[Url]
    public $search;

    /**
     * Shows the form department.
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Hides the form department.
     */
    #[On('hide-form')]
    public function hideForm(): void
    {
        $this->showForm = false;
    }

    /**
     * Refresh the component and reset the page.
     */
    #[On('refresh')]
    public function refresh(): void
    {
        $this->resetPage();
    }

    /**
     * Filters the department by the given company code.
     */
    #[On('filter-company')]
    public function filterCompany($companyCode): void
    {
        $this->filterCompanyCode = $companyCode;
    }

    /**
     * Filters the department by the given branch code.
     */
    #[On('filter-branch')]
    public function filterBranch($branchCode): void
    {
        $this->filterBranchCode = $branchCode;
    }

    /**
     * Retrieves a paginated list of departments based on a search query.
     *
     * @return LengthAwarePaginator The paginated list of departments.
     */
    #[On('getDepartments')]
    public function getDepartments(): LengthAwarePaginator
    {
        $departments = Department::where(function ($query) {
            $query->where('code', 'like', '%'.$this->search.'%')
                ->orWhere('name', 'like', '%'.$this->search.'%');
        })->orderBy('id');

        if ($this->filterCompanyCode) {
            $departments->where('company_code', $this->filterCompanyCode);
        }

        if ($this->filterBranchCode) {
            $departments->where('branch_code', $this->filterBranchCode);
        }

        return $departments->paginate(10);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.department-table', [
            'departments' => self::getDepartments(),
        ]);
    }
}