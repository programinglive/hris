<?php

namespace App\Livewire;

use App\Models\Brand;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class BrandTable extends Component
{
    use withPagination;

    public $showForm = false;

    #[Url]
    public $search;

    #[Url(keep: true)]
    public $filterCompanyCode;

    #[Url(keep: true)]
    public $filterBranchCode;

    public function mount(): void
    {
        if ($this->filterCompanyCode != '') {
            $this->dispatch('filterBranchCode');
        }
    }

    /**
     * Shows the form brand.
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Hides the form brand.
     */
    #[On('hide-form')]
    public function hideForm(): void
    {
        $this->dispatch('clear-form');
        $this->showForm = false;
    }

    /**
     * Filters the list of brands by company code.
     *
     * @param  string  $companyCode  The company code to filter by.
     */
    #[On('filter-company')]
    public function filterCompany(string $companyCode): void
    {
        $this->filterCompanyCode = $companyCode;
    }

    /**
     * Filters the list of brands by branch code.
     *
     * @param  string  $branchCode  The branch code to filter by.
     */
    #[On('filter-branch')]
    public function filterBranch(string $branchCode): void
    {
        $this->filterBranchCode = $branchCode;
    }

    /**
     * Retrieves a paginated list of brands based on a search query.
     *
     * @return LengthAwarePaginator The paginated list of brands.
     */
    public function getBrands(): LengthAwarePaginator
    {
        $brands = Brand::where(function ($query) {
            $query->where('code', 'like', '%'.$this->search.'%')
                ->orWhere('name', 'like', '%'.$this->search.'%');
        });

        if ($this->filterCompanyCode) {
            $brands->where('company_code', $this->filterCompanyCode);
        }

        if ($this->filterBranchCode) {
            $brands->where('branch_code', $this->filterBranchCode);
        }

        return $brands->orderBy('id')
            ->paginate(10);
    }

    /**
     * Refreshes the list of brands.
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
        return view('livewire.brand-table', [
            'brands' => self::getBrands(),
        ]);
    }
}
