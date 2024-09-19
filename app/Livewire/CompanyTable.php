<?php

namespace App\Livewire;

use App\Models\Company;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyTable extends Component
{
    use withPagination;

    public $showForm = false;

    #[Url(keep: true)]
    public $search;

    #[Url(keep: true)]
    public $companyCode = 'all';

    /**
     * Sets the value of the company code property to the given code.
     *
     * @param  string  $code  The code to set as the company code.
     */
    #[On('setCompany')]
    public function setCompany(string $code): void
    {
        $this->companyCode = $code;
    }

    /**
     * Handles the event when a company is created.
     *
     * @param  int  $companyId  The ID of the created company.
     */
    #[On('company-created')]
    public function companyAdded(int $companyId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a company is updated.
     *
     * @param  int  $companyId  The ID of the updated company.
     */
    #[On('company-updated')]
    public function companyUpdated(int $companyId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a company is deleted.
     */
    #[On('company-deleted')]
    public function companyDeleted(): void
    {
        $this->showForm = false;
        $this->resetPage();
        $this->getCompanies();
    }

    /**
     * Shows the form company.
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Hide the form company.
     */
    #[On('hide-form')]
    public function hideForm(): void
    {
        $this->showForm = false;
        $this->dispatch('refresh-form');
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

        if ($this->companyCode != 'all' && $this->companyCode != '') {
            $companies = Company::where('code', $this->companyCode);
        }

        return $companies
            ->orderBy('id')
            ->paginate(5);
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
