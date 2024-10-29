<?php

namespace App\Livewire;

use App\Models\Level;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class LevelTable extends Component
{
    use withPagination;

    public $showForm = false;

    #[Url]
    public $search;

    /**
     * Shows the form level.
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Hides the form level.
     */
    #[On('hide-form')]
    public function hideForm(): void
    {
        $this->dispatch('clear-form');
        $this->showForm = false;
    }

    /**
     * Retrieves a paginated list of levels based on a search query.
     *
     * @return LengthAwarePaginator The paginated list of levels.
     */
    public function getLevels(): LengthAwarePaginator
    {
        return Level::where(function ($query) {
            $query->where('name', 'like', '%'.$this->search.'%')
                ->orWhere('code', 'like', '%'.$this->search.'%');
        })
            ->orderBy('id', 'asc')
            ->paginate(10);
    }

    /**
     * Refreshes the list of levels.
     */
    #[On('refresh')]
    public function refresh(): void
    {
        $this->resetPage();
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.level-table', [
            'levels' => self::getLevels(),
        ]);
    }
}