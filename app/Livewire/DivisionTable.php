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

    #[Url(keep: true)]
    public $filterCompanyCode;

    #[Url(keep: true)]
    public $filterBranchCode;

    #[Url(keep: true)]
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
        $this->dispatch('clear-form');
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
     * Retrieves a paginated list of divisions based on a search query.
     *
     * @return LengthAwarePaginator The paginated list of divisions.
     */
    public function getDivisions(): LengthAwarePaginator
    {
        $divisions = Division::where(function ($query) {
            $query->where('code', 'like', '%'.$this->search.'%')
                ->orWhere('name', 'like', '%'.$this->search.'%');
        })->orderBy('id');

        if ($this->filterCompanyCode) {
            $divisions->where('company_code', $this->filterCompanyCode);
        }

        if ($this->filterBranchCode) {
            $divisions->where('branch_code', $this->filterBranchCode);
        }

        return $divisions->paginate(10);
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
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.division-table', [
            'divisions' => self::getDivisions(),
        ]);
    }
}