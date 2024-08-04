<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Company;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class BranchTable extends Component
{
    use withPagination;

    public $showForm = false;

    #[Url]
    public $search;

    public $companyId;

    #[Url(keep:true)]
    public ?String $companyCode = "all";

    /**
     * Sets the value of the companyCode property.
     *
     * @param string $code The new value for the companyCode property.
     * @return void
     */
    #[On('setCompanyCode')]
    public function setCompanyCode(string $code): void
    {
        $this->companyCode = $code;
    }

    /**
     * Handles the event when a branch is created.
     *
     * @param int $branchId The ID of the created branch.
     * @return void
     */
    #[On('branch-created')]
    public function branchAdded(int $branchId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a branch is updated.
     *
     * @param int $branchId The ID of the updated branch.
     * @return void
     */
    #[On('branch-updated')]
    public function branchUpdated(int $branchId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a branch is deleted.
     * @return void
     */
    #[On('branch-deleted')]
    public function branchDeleted(): void
    {
        $this->showForm = false;
        $this->resetPage();
        $this->getBranch();
    }

    /**
     * Shows the form branch.
     *
     * @return void
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Retrieves the branch records based on the search criteria.
     *
     * @return LengthAwarePaginator The paginated branch records.
     */
    public function getBranch(): LengthAwarePaginator
    {
        if($this->companyCode == "") {
            abort(404);
        }

        $branches = Branch::where(function($query){
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('code', 'like', '%' . $this->search . '%');
        });

        if($this->companyCode != "all") {
            $this->companyId = Company::where("code", $this->companyCode)->first()->id;
            $branches = $branches->where('company_id', $this->companyId);
        }

        return $branches->orderBy('id')->paginate(5);

    }

    /**
     * Render the livewire component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.branch-table',[
            'branches' => self::getBranch()
        ]);
    }
}