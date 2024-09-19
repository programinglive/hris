<?php

namespace App\Livewire;

use App\Models\Division;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class DivisionTable extends Component
{
    use withPagination;

    public $showForm = false;

    #[Url]
    public $search;

    /**
     * Handles the event when a division is created.
     *
     * @param  int  $divisionId  The ID of the created division.
     */
    #[On('division-created')]
    public function divisionAdded(int $divisionId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a division is updated.
     *
     * @param  int  $divisionId  The ID of the updated division.
     */
    #[On('division-updated')]
    public function divisionUpdated(int $divisionId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a division is deleted.
     */
    #[On('division-deleted')]
    public function divisionDeleted(): void
    {
        $this->showForm = false;
        $this->resetPage();
        $this->getDivisions();
    }

    /**
     * Shows the form division.
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Retrieves a paginated list of divisions based on a search query.
     *
     * @return LengthAwarePaginator The paginated list of divisions.
     */
    public function getDivisions(): LengthAwarePaginator
    {
        return Division::where(function ($query) {
            $query->where('name', 'like', '%'.$this->search.'%')
                ->orWhere('code', 'like', '%'.$this->search.'%');
        })
            ->orderBy('id', 'asc')
            ->paginate(5);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.division-table', [
            'divisions' => self::getDivisions(),
        ]);
    }
}
