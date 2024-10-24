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
     * Shows the form division.
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Hides the form division.
     */
    #[On('hide-form')]
    public function hideForm(): void
    {
        $this->showForm = false;
    }

    /**
     * Refreshes the component when the refresh event is triggered.
     */
    #[On('refresh')]
    public function refresh(): void
    {
        $this->resetPage();
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
            ->orderBy('id')
            ->paginate(10);
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
