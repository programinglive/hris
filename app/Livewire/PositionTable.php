<?php

namespace App\Livewire;

use App\Models\Position;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PositionTable extends Component
{
    use withPagination;
    public $showForm = false;

    #[Url]
    public $search;

    /**
     * Handles the event when a position is created.
     *
     * @param int $positionId The ID of the created position.
     * @return void
     */
    #[On('position-created')]
    public function positionAdded(int $positionId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a position is updated.
     *
     * @param int $positionId The ID of the updated position.
     * @return void
     */
    #[On('position-updated')]
    public function positionUpdated(int $positionId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a position is deleted.
     * @return void
     */
    #[On('position-deleted')]
    public function positionDeleted(): void
    {
        $this->showForm = false;
        $this->resetPage();
        $this->getPositions();
    }

    /**
     * Shows the form position.
     *
     * @return void
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Retrieves a paginated list of positions based on a search query.
     *
     * @return LengthAwarePaginator The paginated list of positions.
     */
    public function getPositions(): LengthAwarePaginator
    {
        return Position::where(function($query){
            $query
                ->where('code','like','%'.$this->search.'%')
                ->where('name','like','%'.$this->search.'%');
            })
            ->orderBy('id','asc')->paginate(5);
    }

    /**
     * Render the livewire component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.position-table',[
            'positions' => self::getPositions()
        ]);
    }
}