<?php

namespace App\Livewire;

use App\Models\Company;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CompanyTable extends Component
{
    use WithFileUploads, withPagination;

    public $showForm = false;

    #[Url(keep: true)]
    public $search;

    #[Url(keep: true)]
    public $filterCompanyCode;

    /**
     * Shows the form company.
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
        $this->resetPage();
    }

    /**
     * Hide the form company.
     */
    #[On('hide-form')]
    public function hideForm(): void
    {
        $this->showForm = false;
        $this->resetPage();
    }

    #[On('refresh')]
    public function refresh(): void
    {
        $this->resetPage();
    }

    /**
     * Shows an error message that the company has branches.
     */
    #[On('company-has-branch')]
    public function companyHasBranch(): void
    {
        $this->addError('errorMessages', 'Company has a Branch.');
    }

    #[On('filter-company')]
    /**
     * Filter the company.
     *
     * @param  string  $companyCode  The code of the company to filter.
     */
    public function filterCompany(string $companyCode): void
    {
        $this->filterCompanyCode = $companyCode;
    }

    /**
     * Retrieves a paginated list of companies based on a search query.
     *
     * @return LengthAwarePaginator The paginated list of companies.
     */
    public function getCompanies(): LengthAwarePaginator
    {
        $companies = Company::where(function ($query) {
            $query->where('code', 'like', '%'.$this->search.'%')
                ->orWhere('name', 'like', '%'.$this->search.'%');
        });

        if ($this->filterCompanyCode != '') {
            $companies = Company::where('code', $this->filterCompanyCode);
        }

        return $companies
            ->orderBy('id')
            ->paginate(10);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.company-table', [
            'companies' => self::getCompanies(),
        ]);
    }
}
