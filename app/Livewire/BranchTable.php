<?php

namespace App\Livewire;

use App\Http\Controllers\BranchController;
use App\Http\Controllers\CompanyController;
use App\Models\Branch;
use App\Models\Company;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\SimpleExcel\SimpleExcelReader;

class BranchTable extends Component
{
    use WithFileUploads, withPagination;

    public $showForm = false;

    #[Url]
    public $search;

    public $companyId;

    #[Url(keep: true)]
    public ?string $companyCode = 'all';

    public $import;

    public function importBranch(): void
    {
        $this->validate([
            'import' => 'required|mimes:csv,xlsx,xls',
        ]);

        $this->import->store(path: 'branches');

        $this->import = $this->import->path();

        SimpleExcelReader::create($this->import)->getRows()
            ->each(function (array $rowProperties) {

                if (! array_key_exists('company_name', $rowProperties)) {
                    $this->addError('errorMessage', 'Company Name Required');

                    return;
                }

                $branch = Branch::firstOrNew([
                    'name' => $rowProperties['name'],
                ]);

                $company = Company::firstOrNew([
                    'name' => $rowProperties['company_name'],
                ]);

                if (! $company->code) {
                    $company->code = CompanyController::generateCode();
                    $company->name = $rowProperties['company_name'];
                    $company->save();
                }

                if (! $branch->code) {
                    $branch->code = BranchController::generateCode();
                }

                $branch->company_id = $company->id;
                $branch->company_name = $company->name;
                $branch->company_code = $company->code;
                $branch->save();
            }
            );

        redirect()->back();

    }

    /**
     * Sets the value of the companyCode property.
     *
     * @param  string  $code  The new value for the companyCode property.
     */
    #[On('setCompany')]
    public function setCompany(string $code): void
    {
        $this->companyCode = $code;
    }

    /**
     * Handles the event when a branch is created.
     *
     * @param  int  $branchId  The ID of the created branch.
     */
    #[On('branch-created')]
    public function branchAdded(int $branchId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a branch is updated.
     *
     * @param  int  $branchId  The ID of the updated branch.
     */
    #[On('branch-updated')]
    public function branchUpdated(int $branchId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a branch is deleted.
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

        return $branches->orderBy('id')->paginate(5);

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
