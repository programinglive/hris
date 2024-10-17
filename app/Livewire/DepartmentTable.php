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

    public $companyId;

    #[Url(keep: true)]
    public $companyCode;

    #[Url]
    public $search;

    /**
     * Initializes the component by setting the company ID based on the provided code.
     */
    public function mount(): void
    {
        if ($this->companyCode != 'all') {
            $this->companyId = Company::where('code', $this->companyCode)->first()->id;
        }
    }

    /**
     * Sets the company ID based on the provided code.
     *
     * @param  string  $code  The code of the company.
     */
    #[On('setCompany')]
    public function setCompany(string $code): void
    {
        if ($code != 'all') {
            $this->companyCode = $code;
            $this->companyId = Company::where('code', $code)->first()->id;
        } else {
            $this->companyCode = 'all';
        }

        $this->resetPage();
    }

    /**
     * Handles the event when a department is created.
     *
     * @param  int  $departmentId  The ID of the created department.
     */
    #[On('department-created')]
    public function departmentAdded(int $departmentId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a department is updated.
     *
     * @param  int  $departmentId  The ID of the updated department.
     */
    #[On('department-updated')]
    public function departmentUpdated(int $departmentId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a department is deleted.
     */
    #[On('department-deleted')]
    public function departmentDeleted(): void
    {
        $this->showForm = false;

        $this->resetPage();
        $this->getDepartments();
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

        if ($this->companyCode == '') {
            $this->companyCode = 'all';
        }
        if ($this->companyCode != 'all') {
            $departments = $departments->where('company_id', $this->companyId);
        }

        return $departments->paginate(5);
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