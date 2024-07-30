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
     * Handles the event when a level is created.
     *
     * @param int $levelId The ID of the created level.
     * @return void
     */
    #[On('level-created')]
    public function levelAdded(int $levelId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a level is updated.
     *
     * @param int $levelId The ID of the updated level.
     * @return void
     */
    #[On('level-updated')]
    public function levelUpdated(int $levelId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a level is deleted.
     * @return void
     */
    #[On('level-deleted')]
    public function levelDeleted(): void
    {
        $this->showForm = false;
        $this->resetPage();
        $this->getLevels();
    }

    /**
     * Shows the form level.
     *
     * @return void
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Retrieves a paginated list of levels based on a search query.
     *
     * @return LengthAwarePaginator The paginated list of levels.
     */
    public function getLevels(): LengthAwarePaginator
    {
        return Level::where(function($query){
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('code', 'like', '%' . $this->search . '%');
            })
                ->orderBy('id','asc')
                ->paginate(5);
    }

    /**
     * Render the livewire component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.level-table',[
            'levels' => self::getLevels()
        ]);
    }
}