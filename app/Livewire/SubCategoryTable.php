<?php

namespace App\Livewire;

use App\Http\Controllers\BranchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\SubCategoryController;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Company;
use App\Models\SubCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\SimpleExcel\SimpleExcelReader;

class SubCategoryTable extends Component
{
    use WithFileUploads, withPagination;

    public $showForm = false;

    #[Url]
    public $search;

    #[Url(keep: true)]
    public $companyCode;

    public $import;

    public function importSubCategory(): void
    {
        $this->validate([
            'import' => 'required|mimes:csv,xlsx,xls',
        ]);

        $this->import->store(path: 'sub_categories');

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
                    $company->save();
                }

                $branch = Branch::firstOrNew([
                    'name' => $rowProperties['branch_name'],
                ]);

                if (! $branch->code) {
                    $branch = BranchController::createByName($company, $rowProperties['branch_name']);
                }

                $branch->save();

                $category = Category::firstOrNew([
                    'name' => $rowProperties['category_name'],
                ]);

                if (! $category->code) {
                    $category->company_id = $company->id;
                    $category->branch_id = $branch->id ?? null;
                    $category->code = CategoryController::generateCode();
                    $category->company_code = $company->code;
                    $category->company_name = $company->name;
                }

                $category->save();

                $subCategory = SubCategory::firstOrNew([
                    'name' => $name,
                ]);

                if (! $subCategory->code) {
                    $subCategory->company_id = $company->id;
                    $subCategory->branch_id = $branch->id ?? null;
                    $subCategory->category_id = $category->id;
                    $subCategory->code = SubCategoryController::generateCode();
                    $subCategory->company_code = $company->code;
                    $subCategory->company_name = $company->name;
                }

                $subCategory->save();
            });

        redirect()->back();
    }

    /**
     * Shows the form subCategory.
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    #[On('hide-form')]
    public function hideForm(): void
    {
        $this->dispatch('clear-form');
        $this->showForm = false;
    }

    /**
     * Retrieves a paginated list of subCategories based on a search query.
     *
     * @return LengthAwarePaginator The paginated list of subCategories.
     */
    public function getSubCategories(): LengthAwarePaginator
    {
        $subCategories = SubCategory::where(function ($query) {
            $query->where('code', 'like', '%'.$this->search.'%')
                ->orWhere('name', 'like', '%'.$this->search.'%');
        });

        return $subCategories->orderBy('id')
            ->paginate(10);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.sub-category-table', [
            'subCategories' => self::getSubCategories(),
        ]);
    }
}
