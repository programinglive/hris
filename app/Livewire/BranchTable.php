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
    public $companyCode;

    /**
     * Sets the value of the companyCode property.
     *
     * @param  string  $code  The new value for the companyCode property.
     */
    #[On('set-company')]
    public function setCompany(string $code): void
    {
        $this->companyCode = $code;
    }

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
     * Retrieves the branch records based on the search criteria.
     *
     * @return LengthAwarePaginator The paginated branch records.
     */
    public function getBranch(): LengthAwarePaginator
    {
        if ($this->companyCode == '') {
            $this->companyCode = 'all';
        }

        $branches = new Branch;

        if ($this->search != '' || ! $this->search) {
            $branches = Branch::where(function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('code', 'like', '%'.$this->search.'%');
            });
        }

        if ($this->companyCode != 'all') {
            $branches->where('company_code', $this->companyCode);
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