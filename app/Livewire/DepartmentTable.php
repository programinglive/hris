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

    #[Url]
    public $search;

    /**
     * Handles the event when a department is created.
     *
     * @param int $departmentId The ID of the created department.
     * @return void
     */
    #[On('department-created')]
    public function departmentAdded(int $departmentId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a department is updated.
     *
     * @param int $departmentId The ID of the updated department.
     * @return void
     */
    #[On('department-updated')]
    public function departmentUpdated(int $departmentId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a department is deleted.
     * @return void
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
     *
     * @return void
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
    public function getDepartments(): LengthAwarePaginator
    {
        return Department::where(function($query){
            $query->where('code', 'like', '%' . $this->search . '%')
                ->orWhere('name', 'like', '%' . $this->search . '%');
            })->orderBy('id', 'asc')
            ->paginate(5);
    }

    /**
     * Render the livewire component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.department-table',[
            'departments' => self::getDepartments()
        ]);
    }
}