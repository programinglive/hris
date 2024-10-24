<?php

namespace App\Livewire;

use App\Models\Company;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportCompany extends Component
{
    use WithFileUploads;

    public $import;

    /**
     * Handle import company
     */
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
                    'code' => $rowProperties['code'],
                ]);
                $company->name = $rowProperties['name'];
                $company->npwp = $rowProperties['npwp'];
                $company->email = $rowProperties['email'];
                $company->address = $rowProperties['address'];
                $company->phone = $rowProperties['phone'];
                $company->save();
            }
            );

        $this->dispatch('refresh');

    }

    public function render(): View
    {
        return view('livewire.import-company');
    }
}
