<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Company;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportUser extends Component
{
    use WithFileUploads;

    public $import;

    public $company;

    public $companyId;

    public $companyCode;

    public $companyName;

    public $branch;

    public $branchId;

    public $branchCode;

    public $branchName;

    /**
     * Handles the event when the import field is updated.
     *
     * This function will validate the uploaded file and store it in the
     * 'photos' directory.
     * The path of the uploaded file will be stored in
     * the $this→import variable.
     */
    public function importUser(): void
    {
        // check if a company exists
        $company = Company::first();

        if (! $company) {
            $this->addError('errorMessage', 'Company not found');

            return;
        }

        // check if a branch exists
        $branch = Branch::first();

        if (! $branch) {
            $this->addError('errorMessage', 'Branch not found');

            return;
        }

        $this->validate([
            'import' => 'required|mimes:csv,xlsx,xls',
        ]);

        $this->import->store(path: 'users');

        $this->import = $this->import->path();

        SimpleExcelReader::create($this->import)->getRows()
            ->each(function (array $rowProperties) {

                $this->company = Company::where('code', $rowProperties['comp_code'])->first();

                $this->branch = Branch::where('code', $rowProperties['branch_code'])->first();

                $checkUser = User::where('name', $rowProperties['name'])->first();

                if (! $checkUser) {
                    if ($rowProperties['email'] == '') {
                        $rowProperties['email'] = time().'@test.com';
                    }

                    $user = User::create([
                        'name' => $rowProperties['name'],
                        'password' => bcrypt('hris123'),
                        'email' => $rowProperties['email'] == '' ? time().'@test.com' : $rowProperties['name'].'@test.com',
                    ]);

                    UserDetail::create([
                        'company_id' => $this->company?->id,
                        'branch_id' => $this->branch?->id,
                        'user_id' => $user->id,
                        'company_code' => $this->company?->code,
                        'company_name' => $this->company?->name,
                        'branch_code' => $this->branch?->code,
                        'branch_name' => $this->branch?->name,
                        'nik' => $rowProperties['nik'],
                        'first_name' => $rowProperties['first_name'],
                        'last_name' => $rowProperties['last_name'],
                        'date_in' => $rowProperties['date_in'] == '' ? null : $rowProperties['date_in'],
                        'date_out' => $rowProperties['date_out'] == '' ? null : $rowProperties['date_out'],
                    ]);

                } else {
                    $this->addError('errorMessage', 'No data Submited');
                }
            });

        $this->dispatch('refresh');
    }

    public function render(): View
    {
        return view('livewire.import-user');
    }
}
