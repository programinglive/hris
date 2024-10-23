<?php

namespace App\Livewire;

use App\Http\Controllers\CompanyController;
use App\Models\Company;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportCompany extends Component
{

    public $import;

    public function importCompany(): void
    {
        $this->validate([
            'import' => 'required|mimes:csv,xlsx,xls',
        ]);

        $this->import->store(path: 'companies');

        $this->import = $this->import->path();

        SimpleExcelReader::create($this->import)->getRows()
            ->each(function (array $rowProperties) {
                $company = Company::firstOrNew([
                    'code' => CompanyController::generateCode(),
                    'phone' => $rowProperties['phone'],
                ]);

                $company->name = $rowProperties['name'];
                $company->email = $rowProperties['email'];
                $company->address = $rowProperties['address'];
                $company->save();
            }
        );

    }

    public function render(): View
    {
        return view('livewire.import-company');
    }
}