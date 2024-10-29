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

    #[Url(keep: true)]
    public $filterCompanyCode;

    #[Url(keep: true)]
    public $filterBranchCode;

    #[Url(keep: true)]
    public $search;

    /**
     * Shows the form subDivision.
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    #[On('hide-form')]
    public function hideForm(): void
    {
        $this->dispatch('clear-form');
        $this->showForm = false;
    }

    #[On('refresh')]
    public function refresh(): void
    {
        $this->resetPage();
    }

    /**
     * Filters the subDivision by the given company code.
     */
    #[On('filter-company')]
    public function filterCompany($companyCode): void
    {
        $this->filterBranchCode = '';
        $this->filterCompanyCode = $companyCode;
    }

    /**
     * Filters the subDivision by the given branch code.
     */
    #[On('filter-branch')]
    public function filterBranch($branchCode): void
    {
        $this->filterBranchCode = $branchCode;
    }

    /**
     * Retrieves a paginated list of subDivisions based on a search query.
     *
     * @return LengthAwarePaginator The paginated list of subDivisions.
     */
    public function getSubDivisions(): LengthAwarePaginator
    {
        $subDivision = SubDivision::where(function ($query) {
            $query->where('code', 'like', '%'.$this->search.'%')
                ->orWhere('name', 'like', '%'.$this->search.'%');
        })->orderBy('id');

        if ($this->filterCompanyCode) {
            $subDivision->where('company_code', $this->filterCompanyCode);
        }

        if ($this->filterBranchCode) {
            $subDivision->where('branch_code', $this->filterBranchCode);
        }

        return $subDivision->paginate(10);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.sub-division-table', [
            'subDivisions' => self::getSubDivisions(),
        ]);
    }
}
