<?php

namespace App\Livewire;

use App\Http\Controllers\BranchController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\WorkingDayController;
use App\Models\Company;
use App\Models\WorkingDay;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\SimpleExcel\SimpleExcelReader;

class WorkingDayTable extends Component
{
    use WithFileUploads, withPagination;

    public $showForm = false;

    #[Url]
    public $search;

    #[Url(keep: true)]
    public $companyCode = 'all';

    public $import;

    public function importWorkingDay(): void
    {
        $this->validate([
            'import' => 'required|mimes:csv,xlsx,xls',
        ]);

        $this->import->store(path: 'workingDays');

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

                $category = WorkingDay::firstOrNew([
                    'name' => $name,
                ]);

                if (! $category->code) {
                    $category->company_id = $company->id;
                    $category->branch_id = $branch->id ?? null;
                    $category->code = WorkingDayController::generateCode();
                    $category->company_code = $company->code;
                    $category->company_name = $company->name;
                    $category->branch_code = $branch->code ?? null;
                    $category->branch_name = $branch->name ?? null;
                }

                $category->save();
            });

        redirect()->back();
    }

    /**
     * Sets the company code.
     *
     * @param  string  $code  The code to set as the company code.
     */
    #[On('setCompany')]
    public function setCompany(string $code): void
    {
        $this->companyCode = $code;
    }

    /**
     * Handles the event when a category is created.
     *
     * @param  int  $categoryId  The ID of the created category.
     */
    #[On('category-created')]
    public function categoryAdded(int $categoryId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a category is updated.
     *
     * @param  int  $categoryId  The ID of the updated category.
     */
    #[On('category-updated')]
    public function categoryUpdated(int $categoryId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a category is deleted.
     */
    #[On('category-deleted')]
    public function categoryDeleted(): void
    {
        $this->showForm = false;
        $this->resetPage();
        $this->getWorkingDay();
    }

    /**
     * Shows the form category.
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Retrieves a paginated list of workingDays based on a search query.
     *
     * @return LengthAwarePaginator The paginated list of workingDays.
     */
    public function getWorkingDay(): LengthAwarePaginator
    {
        $workingDays = WorkingDay::where(function ($query) {
            $query->where('code', 'like', '%'.$this->search.'%')
                ->orWhere('name', 'like', '%'.$this->search.'%');
        });

        if ($this->companyCode !== 'all') {
            $company = Company::where('code', $this->companyCode)->first();
            $workingDays = $workingDays->where(
                'company_id', $company?->id);
        }

        return $workingDays->orderBy('id')
            ->paginate(5);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.working-day-table', [
            'workingDays' => self::getWorkingDay(),
        ]);
    }
}
