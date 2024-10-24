<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Brand;
use App\Models\Company;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportBrand extends Component
{
    use WithFileUploads;

    public $import;

    public function importBrand(): void
    {
        $this->validate([
            'import' => 'required|mimes:csv,xlsx,xls',
        ]);

        $this->import->store(path: 'branches');

        $this->import = $this->import->path();

        SimpleExcelReader::create($this->import)->getRows()
            ->each(function (array $rowProperties) {

                if ($rowProperties['company_code'] != '') {

                    $company = Company::where(
                        'code', $rowProperties['company_code']
                    )->first();

                    if ($company) {
                        $branch = Branch::where(
                            'code', $rowProperties['branch_code']
                        )->first();

                        if($branch) {
                            $brand = Brand::firstOrNew([
                                'code' => $rowProperties['code'],
                            ]);

                            $brand->name = $rowProperties['name'];
                            $brand->description = $rowProperties['description'];
                            $brand->company_code = $rowProperties['company_code'];
                            $brand->company_name = $company->name;
                            $brand->branch_code = $rowProperties['branch_code'];
                            $brand->branch_name = $branch->name;

                            $brand->save();
                        }
                    }
                }
            }
        );

        $this->dispatch('refresh');

    }

    public function render(): View
    {
        return view('livewire.import-brand');
    }
}