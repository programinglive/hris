<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeLeavePlafondTable extends Component
{
    use withPagination;

    public $showForm = false;

    #[Url(keep: true)]
    public $search;

    /**
     * Handles the event when a employee is created.
     *
     * @param  int  $employeeId  The ID of the created employee.
     */
    #[On('employee-created')]
    public function employeeAdded(int $employeeId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a employee is updated.
     *
     * @param  int  $employeeId  The ID of the updated employee.
     */
    #[On('employee-updated')]
    public function employeeUpdated(int $employeeId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a employee is deleted.
     */
    #[On('employee-deleted')]
    public function employeeDeleted(): void
    {
        $this->showForm = false;
        $this->resetPage();
        $this->getEmployeeLeavePlafonds();
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
     * Retrieves a paginated list of employees based on a search query.
     *
     * @return LengthAwarePaginator The paginated list of employees.
     */
    public function getEmployeeLeavePlafonds(): LengthAwarePaginator
    {
        return User::where('name', 'like', '%'.$this->search.'%')
            ->whereNot('name', 'admin')
            ->paginate(10);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.employee-leave-plafond-table', [
            'employeeLeavePlafonds' => self::getEmployeeLeavePlafonds(),
        ]);
    }
}
