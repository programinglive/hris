<?php

namespace App\Livewire;

use App\Models\Company;
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

    public $companyId;

    #[Url(keep: true)]
    public $companyCode;

    public $companyName;

    public $branch;

    public $branchId;

    #[Url(keep: true)]
    public $branchCode;

    public $branchName;

    #[Url]
    public $search;

    /**
     * Sets the company ID based on the provided code.
     *
     * @param  string  $code  The code of the company.
     */
    #[On('set-company')]
    public function setCompany(string $code): void
    {
        if ($code != 'all') {
            $this->companyCode = $code;
            $this->company = Company::where('code', $code)->first();
            $this->companyId = $this->company->id;
            $this->companyName = $this->company->name;
        }

        $this->resetPage();
    }

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
