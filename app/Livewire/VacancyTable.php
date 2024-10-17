<?php

namespace App\Livewire;

use App\Http\Controllers\BranchController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\VacancyController;
use App\Models\Company;
use App\Models\Vacancy;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\SimpleExcel\SimpleExcelReader;

class VacancyTable extends Component
{
    use WithFileUploads, withPagination;

    public $showForm = false;

    #[Url]
    public $search;

    #[Url(keep: true)]
    public $companyCode;

    public $import;

    public function importVacancy(): void
    {
        $this->validate([
            'import' => 'required|mimes:csv,xlsx,xls',
        ]);

        $this->import->store(path: 'vacancies');

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

                $vacancy = Vacancy::firstOrNew([
                    'name' => $name,
                ]);

                if (! $vacancy->code) {
                    $vacancy->company_id = $company->id;
                    $vacancy->branch_id = $branch->id ?? null;
                    $vacancy->code = VacancyController::generateCode();
                    $vacancy->company_code = $company->code;
                    $vacancy->company_name = $company->name;
                    $vacancy->branch_code = $branch->code ?? null;
                    $vacancy->branch_name = $branch->name ?? null;
                }

                $vacancy->save();
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
     * Handles the event when a vacancy is created.
     *
     * @param  int  $vacancyId  vacancyId The ID of the created vacancy.
     */
    #[On('vacancy-created')]
    public function vacancyAdded(int $vacancyId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a vacancy is updated.
     *
     * @param  int  $vacancyId  vacancyId The ID of the updated vacancy.
     */
    #[On('vacancy-updated')]
    public function vacancyUpdated(int $vacancyId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a vacancy is deleted.
     */
    #[On('vacancy-deleted')]
    public function vacancyDeleted(): void
    {
        $this->showForm = false;
        $this->resetPage();
        $this->getCategories();
    }

    /**
     * Shows the form vacancy.
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Retrieves a paginated list of vacancies based on a search query.
     *
     * @return LengthAwarePaginator The paginated list of vacancies.
     */
    public function getCategories(): LengthAwarePaginator
    {
        $vacancies = Vacancy::where(function ($query) {
            $query->where('code', 'like', '%'.$this->search.'%')
                ->orWhere('title', 'like', '%'.$this->search.'%');
        });

        if ($this->companyCode !== 'all') {
            $vacancies = $vacancies->where('company_id', Company::where('code', $this->companyCode)->first()?->id);
        }

        return $vacancies->orderBy('id')
            ->paginate(5);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.vacancy-table', [
            'vacancies' => self::getCategories(),
        ]);
    }
}
