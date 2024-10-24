<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Company;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportBranch extends Component
{
    use WithFileUploads;

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

                if ($rowProperties['company_code'] != '') {

                    $company = Company::where(
                        'code', $rowProperties['company_code']
                    )->first();

                    if ($company) {
                        $branch = Branch::firstOrNew([
                            'code' => $rowProperties['code'],
                        ]);

                        $branch->name = $rowProperties['name'];
                        $branch->address = $rowProperties['address'];
                        $branch->phone = $rowProperties['phone'];
                        $branch->company_code = $rowProperties['company_code'];
                        $branch->company_name = $company->name;
                        $branch->save();
                    }
                }
            }
            );

        $this->dispatch('refresh');
    }

    public function render(): View
    {
        return view('livewire.import-branch');
    }
}
