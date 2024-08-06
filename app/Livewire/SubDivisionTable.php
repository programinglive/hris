<?php

namespace App\Livewire;

use App\Models\SubDivision;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class SubDivisionTable extends Component
{
    use withPagination;
    public $showForm = false;

    #[Url]
    public $search;

    /**
     * Handles the event when a subDivision is created.
     *
     * @param int $subDivisionId The ID of the created subDivision.
     * @return void
     */
    #[On('sub-division-created')]
    public function subDivisionAdded(int $subDivisionId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a subDivision is updated.
     *
     * @param int $subDivisionId The ID of the updated subDivision.
     * @return void
     */
    #[On('sub-division-updated')]
    public function subDivisionUpdated(int $subDivisionId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a subDivision is deleted.
     * @return void
     */
    #[On('sub-division-deleted')]
    public function subDivisionDeleted(): void
    {
        $this->showForm = false;
        $this->resetPage();
        $this->getSubDivisions();
    }

    /**
     * Shows the form subDivision.
     *
     * @return void
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Retrieves a paginated list of subDivisions based on a search query.
     *
     * @return LengthAwarePaginator The paginated list of subDivisions.
     */
    public function getSubDivisions(): LengthAwarePaginator
    {
        return SubDivision::where(function ($query){
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('code', 'like', '%' . $this->search . '%');
        })
            ->orderBy('id', 'asc')
            ->paginate(5);
    }

    /**
     * Render the livewire component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.sub-division-table',[
            'subDivisions' => self::getSubDivisions()
        ]);
    }
}