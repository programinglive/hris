<?php

namespace App\Livewire;

use App\Models\Branch;
use Illuminate\Contracts\View\View;
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
    #[on('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    public function getBranch()
    {
        return Branch::where('company_id', auth()->user()->details->company_id)
            ->where('type', 'branch')
            ->where('code', 'like', '%' . $this->search . '%')
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