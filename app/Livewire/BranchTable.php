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

    #[Url(keep:true)]
    public ?String $companyCode = "";

    #[On('setCompanyCode')]
    public function setCompanyCode($code): void
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
        return  $this->companyCode != "" ?
            Branch::where('company_id',Company::where('code', $this->companyCode)->first()->id)
                ->where(function($query){
                    $query->where('code', 'like', '%' . $this->search . '%')
                        ->orWhere('name', 'like', '%' . $this->search . '%');
                })
                ->orderBy('id', 'asc')
                ->paginate(5)
            : Branch::where(function($query){
                $query->where('code', 'like', '%' . $this->search . '%')
                    ->orWhere('name', 'like', '%' . $this->search . '%');
            })
                ->orderBy('id', 'asc')
                ->paginate(5);

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