<?php

namespace App\Livewire;

use App\Models\Position;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PositionTable extends Component
{
    use withPagination;

    public $showForm = false;

    #[Url(keep: true)]
    public $search;

    #[Url(keep: true)]
    public $filterCompanyCode;

    #[Url(keep: true)]
    public $filterBranchCode;

    /**
     * Shows the form position.
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Hides the form position.
     */
    #[On('hide-form')]
    public function hideForm(): void
    {
        $this->dispatch('clear-form');
        $this->showForm = false;
    }

    /**
     * Handles the refresh event.
     */
    #[On('filter-company')]
    public function filterCompany($companyCode): void
    {
        $this->filterBranchCode = '';
        $this->filterCompanyCode = $companyCode;
    }

    /**
     * Filters the division by the given branch code.
     */
    #[On('filter-branch')]
    public function filterBranch($branchCode): void
    {
        $this->filterBranchCode = $branchCode;
    }


    /**
     * Retrieves a paginated list of positions based on a search query.
     *
     * @return array|LengthAwarePaginator The paginated list of positions.
     */
    public function getPositions(): array|LengthAwarePaginator
    {
        $positions = Position::where(function ($query) {
            $query->where('code', 'like', '%'.$this->search.'%')
                ->orWhere('name', 'like', '%'.$this->search.'%');
        })->orderBy('id');

        if ($this->filterCompanyCode) {
            $positions->where('company_code', $this->filterCompanyCode);
        }

        if ($this->filterBranchCode) {
            $positions->where('branch_code', $this->filterBranchCode);
        }

        return $positions->paginate(10);
    }

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
        return view('livewire.position-table', [
            'positions' => self::getPositions(),
        ]);
    }
}