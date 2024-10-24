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
                    $this->addError('errorMessage', 'Company Name Required');

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
    #[On('set-company')]
    public function setCompany(string $code): void
    {
        $this->companyCode = $code;
        $this->dispatch('refresh');
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
     * Hides the form brand.
     */
    #[On('hide-form')]
    public function hideForm(): void
    {
        $this->showForm = false;
    }

    /**
     * Refreshes the list of brands.
     */
    #[On('refresh')]
    public function refresh(): void {}

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

        return $brands->orderBy('id')
            ->paginate(10);
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
