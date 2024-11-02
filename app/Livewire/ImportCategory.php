<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportCategory extends Component
{
    use WithFileUploads;

    public $import;

    public function importCategory(): void
    {
        $this->validate([
            'import' => 'required|mimes:csv,xlsx,xls',
        ]);

        $this->import->store(path: 'categories');

        $this->import = $this->import->path();

        SimpleExcelReader::create($this->import)->getRows()
            ->each(function (array $rowProperties) {
                if( $rowProperties['company_code'] == '' ) {
                    return;
                }

                if( $rowProperties['branch_code'] == '' ) {
                    return;
                }

                $company = Company::where('code', $rowProperties['company_code'])->first();
                $branch = Branch::where('code', $rowProperties['branch_code'])->first();

                $category = Category::firstOrNew([
                    'code' => $rowProperties['code'],
                ]);

                $category->name = $rowProperties['name'];
                $category->company_id = $company->id;
                $category->company_code = $company->code;
                $category->company_name = $company->name;
                $category->branch_id = $branch->id;
                $category->branch_code = $branch->code;
                $category->branch_name = $branch->name;
                $category->save();

            });

        $this->dispatch('refresh');
    }

    public function render(): View
    {
        return view('livewire.import-category');
    }
}