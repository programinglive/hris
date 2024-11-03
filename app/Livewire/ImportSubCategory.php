<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Company;
use App\Models\SubCategory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportSubCategory extends Component
{
    use WithFileUploads;

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

                if ($rowProperties['company_code'] == '') {
                    return;
                }

                if ($rowProperties['branch_code'] == '') {
                    return;
                }

                $company = Company::where('code', $rowProperties['company_code'])->first();
                $branch = Branch::where('code', $rowProperties['branch_code'])->first();
                $category = Category::where('code', $rowProperties['category_code'])->first();

                $subCategory = SubCategory::firstOrNew([
                    'code' => $rowProperties['code'],
                ]);

                $subCategory->name = $rowProperties['name'];
                $subCategory->description = $rowProperties['description'];
                $subCategory->company_id = $company->id;
                $subCategory->company_code = $company->code;
                $subCategory->company_name = $company->name;
                $subCategory->branch_id = $branch->id;
                $subCategory->branch_code = $branch->code;
                $subCategory->branch_name = $branch->name;
                $subCategory->category_id = $category?->id;
                $subCategory->category_code = $category?->code;
                $subCategory->category_name = $category?->name;
                $subCategory->save();
            });

        $this->dispatch('refresh');
    }

    public function render(): View
    {
        return view('livewire.import-sub-category');
    }
}
