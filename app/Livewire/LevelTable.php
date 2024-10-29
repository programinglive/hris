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

    #[Url(keep: true)]
    public $search;

    #[Url(keep: true)]
    public $filterCompanyCode;

    #[Url(keep: true)]
    public $filterBranchCode;

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
     * Retrieves a paginated list of levels based on a search query.
     *
     * @return LengthAwarePaginator The paginated list of levels.
     */
    public function getLevels(): LengthAwarePaginator
    {
        $levels = Level::where(function ($query) {
            $query->where('code', 'like', '%'.$this->search.'%')
                ->orWhere('name', 'like', '%'.$this->search.'%');
        })->orderBy('id');

        if ($this->filterCompanyCode) {
            $levels->where('company_code', $this->filterCompanyCode);
        }

        if ($this->filterBranchCode) {
            $levels->where('branch_code', $this->filterBranchCode);
        }

        return $levels->paginate(10);
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