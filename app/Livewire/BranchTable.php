<?php

namespace App\Livewire;

use App\Models\Branch;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class BranchTable extends Component
{
    use WithFileUploads, withPagination;

    public $showForm = false;

    #[Url]
    public $search;

    public $companyId;

    #[Url(keep: true)]
    public $filterCompanyCode;

    /**
     * Shows the form branch.
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Hide the form branch.
     */
    #[On('hide-form')]
    public function hideForm(): void
    {
        $this->showForm = false;
    }

    #[On('refresh')]
    public function refresh(): void
    {
        $this->resetPage();
    }

    /**
     * Filter the branch.
     *
     * @param string $companyCode  The code of the company to filter.
     */
    #[On('filter-company')]
    public function filterCompany(string $companyCode): void
    {
        $this->filterCompanyCode = $companyCode;
    }

    /**
     * Retrieves the branch records based on the search criteria.
     *
     * @return LengthAwarePaginator The paginated branch records.
     */
    public function getBranch(): LengthAwarePaginator
    {
        $branches = new Branch;

        if ($this->search != '' || ! $this->search) {
            $branches = Branch::where(function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('code', 'like', '%'.$this->search.'%');
            });
        }

        if($this->filterCompanyCode != ''){
            $branches = Branch::where('company_code', $this->filterCompanyCode);
        }

        return $branches->orderBy('id')->paginate(10);

    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.branch-table', [
            'branches' => self::getBranch(),
        ]);
    }
}