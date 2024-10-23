<?php

namespace App\Livewire;

use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CompanyController;
use App\Models\Approval;
use App\Models\Company;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\SimpleExcel\SimpleExcelReader;

class ApprovalTable extends Component
{
    use WithFileUploads, withPagination;

    public $showForm = false;

    #[Url]
    public $search;

    #[Url(keep: true)]
    public $companyCode;

    public $import;

    public function importApproval(): void
    {
        $this->validate([
            'import' => 'required|mimes:csv,xlsx,xls',
        ]);

        $this->import->store(path: 'approvals');

        $this->import = $this->import->path();

        SimpleExcelReader::create($this->import)->getRows()
            ->each(function (array $rowProperties) {
                $name = trim(
                    strtolower(
                        str_replace(' ', '', $rowProperties['name'])
                    )
                );

                $company = Company::firstOrNew([
                    'name' => $rowProperties['company_name'],
                ]);

                if (! $company->code) {
                    $company->code = CompanyController::generateCode();
                }

                $company->save();

                if ($rowProperties['branch_name']) {
                    $branch = BranchController::createByName($company, $rowProperties['branch_name']);
                }

                $approval = Approval::firstOrNew([
                    'name' => $name,
                ]);

                if (! $approval->code) {
                    $approval->company_id = $company->id;
                    $approval->branch_id = $branch->id ?? null;
                    $approval->code = ApprovalController::generateCode();
                    $approval->company_code = $company->code;
                    $approval->company_name = $company->name;
                    $approval->branch_code = $branch->code ?? null;
                    $approval->branch_name = $branch->name ?? null;
                }

                $approval->save();
            });

        redirect()->back();
    }

    /**
     * Sets the company code.
     *
     * @param  string  $code  The code to set as the company code.
     */
    #[On('set-company')]
    public function setCompany(string $code): void
    {
        $this->companyCode = $code;
    }

    /**
     * Handles the event when a approval is created.
     *
     * @param  int  $approvalId  The ID of the created approval.
     */
    #[On('approval-created')]
    public function approvalAdded(int $approvalId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a approval is updated.
     *
     * @param  int  $approvalId  The ID of the updated approval.
     */
    #[On('approval-updated')]
    public function approvalUpdated(int $approvalId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a approval is deleted.
     */
    #[On('approval-deleted')]
    public function approvalDeleted(): void
    {
        $this->showForm = false;
        $this->resetPage();
        $this->getApprovals();
    }

    /**
     * Shows the form approval.
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Retrieves a paginated list of approvals based on a search query.
     *
     * @return LengthAwarePaginator The paginated list of approvals.
     */
    public function getApprovals(): LengthAwarePaginator
    {
        $approvals = Approval::where(function ($query) {
            $query->where('code', 'like', '%'.$this->search.'%')
                ->orWhere('name', 'like', '%'.$this->search.'%');
        });

        if ($this->companyCode !== 'all') {
            $approvals = $approvals->where('company_id', Company::where('code', $this->companyCode)->first()?->id);
        }

        return $approvals->orderBy('id')
            ->paginate(10);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.approval-table', [
            'approvals' => self::getApprovals(),
        ]);
    }
}
