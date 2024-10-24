<?php

namespace App\Livewire;

use App\Models\WorkingShift;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class WorkingShiftTable extends Component
{
    use WithFileUploads, withPagination;

    public $showForm = false;

    #[Url]
    public $search;

    #[Url(keep: true)]
    public $companyCode;

    /**
     * Sets the company code.
     *
     * @param  string  $code  The code to set as the company code.
     */
    #[On('set-company')]
    public function setCompany(string $code): void
    {
        $this->companyCode = $code;
        $this->dispatch('refresh');
    }

    /**
     * Handles the event when a workingShift is created.
     *
     * @param  int  $workingShiftId  The ID of the created workingShift.
     */
    #[On('working-shift-created')]
    public function workingShiftAdded(int $workingShiftId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a workingShift is updated.
     *
     * @param  int  $workingShiftId  The ID of the updated workingShift.
     */
    #[On('working-shift-updated')]
    public function workingShiftUpdated(int $workingShiftId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a workingShift is deleted.
     */
    #[On('working-shift-deleted')]
    public function workingShiftDeleted(): void
    {
        $this->showForm = false;
        $this->resetPage();
        $this->getWorkingShift();
    }

    /**
     * Shows the form workingShift.
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Hides the form workingShift.
     */
    #[On('hide-form')]
    public function hideForm(): void
    {
        $this->showForm = false;
    }

    /**
     * Refreshes the working shift data.
     */
    #[On('refresh')]
    public function refresh(): void {}

    /**
     * Retrieves a paginated list of workingShifts based on a search query.
     *
     * @return LengthAwarePaginator The paginated list of workingShifts.
     */
    public function getWorkingShift(): LengthAwarePaginator
    {
        $workingShifts = WorkingShift::where(function ($query) {
            $query->where('start_time', 'like', '%'.$this->search.'%')
                ->orWhere('end_time', 'like', '%'.$this->search.'%')
                ->orWhere('name', 'like', '%'.$this->search.'%');
        });

        return $workingShifts->orderBy('id')
            ->paginate(10);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.working-shift-table', [
            'workingShifts' => self::getWorkingShift(),
        ]);
    }
}
