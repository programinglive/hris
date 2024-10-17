<?php

namespace App\Livewire;

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CompanyController;
use App\Models\Brand;
use App\Models\Company;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\SimpleExcel\SimpleExcelReader;

class BrandTable extends Component
{
    use withPagination;

    public $showForm = false;

    public $import;

    #[Url]
    public $search;

    #[Url(keep: true)]
    public $companyCode;

    public function importBrand(): void
    {
        $this->validate([
            'import' => 'required|mimes:csv,xlsx,xls',
        ]);

        $this->import->store(path: 'branches');

        $this->import = $this->import->path();

        SimpleExcelReader::create($this->import)->getRows()
            ->each(function (array $rowProperties) {

                if (! array_key_exists('company_name', $rowProperties)) {
                    $this->addError('messages', 'Company Name Required');

                    return;
                }

                $branch = Brand::firstOrNew([
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
                    $branch->code = BrandController::generateCode();
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
     * Handles the event when a brand is created.
     *
     * @param  int  $brandId  The ID of the created brand.
     */
    #[On('brand-created')]
    public function brandAdded(int $brandId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a brand is updated.
     *
     * @param  int  $brandId  The ID of the updated brand.
     */
    #[On('brand-updated')]
    public function brandUpdated(int $brandId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a brand is deleted.
     */
    #[On('brand-deleted')]
    public function brandDeleted(): void
    {
        $this->showForm = false;
        $this->resetPage();
        $this->getBrands();
    }

    /**
     * Shows the form brand.
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Retrieves a paginated list of brands based on a search query.
     *
     * @return LengthAwarePaginator The paginated list of brands.
     */
    public function getBrands(): LengthAwarePaginator
    {
        $brands = Brand::where(function ($query) {
            $query->where('code', 'like', '%'.$this->search.'%')
                ->orWhere('name', 'like', '%'.$this->search.'%');
        });

        if ($this->companyCode !== 'all') {
            $brands = $brands->where('company_id', Company::where('code', $this->companyCode)->first()?->id);
        }

        return $brands->orderBy('id')
            ->paginate(5);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.brand-table', [
            'brands' => self::getBrands(),
        ]);
    }
}
