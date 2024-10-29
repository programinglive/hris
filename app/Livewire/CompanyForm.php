<?php

namespace App\Livewire;

use App\Http\Controllers\ToolController;
use App\Models\Branch;
use App\Models\Company;
use DB;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CompanyForm extends Component
{
    public $oldCompanyCode;

    #[Validate('required|unique:companies|min:3')]
    public $code;

    #[Validate('required|min:3')]
    public $name;

    public $npwp;

    public $address;

    #[Validate('required|email:unique:companies') ]
    public $email;

    #[Validate('required|unique:companies') ]
    public $phone;

    public $company;

    public $actionForm = 'save';

    /**
     * The default data for the form.
     */
    public function companyData(): array
    {
        return [
            'code' => ToolController::sanitizeString($this->code),
            'name' => $this->name,
            'npwp' => $this->npwp,
            'address' => $this->address,
            'email' => $this->email,
            'phone' => $this->phone,
            'created_by' => auth()->user()->id,
        ];
    }

    /**
     * Saves the company details to the database and dispatches a 'company-created' event.
     */
    public function save(): void
    {
        $this->validate();

        DB::transaction(function () {
            $this->company = Company::create($this->companyData());
        }, 5);

        $this->dispatch('refresh');
        $this->dispatch('hide-form');
    }

    /**
     * Edit the company details.
     */
    #[On('edit')]
    public function edit($code): void
    {
        $this->oldCompanyCode = $code;
        $this->code = $code;
        $this->company = Company::where('code', $code)->first();
        $this->name = $this->company->name;
        $this->npwp = $this->company->npwp;
        $this->address = $this->company->address;
        $this->email = $this->company->email;
        $this->phone = $this->company->phone;

        $this->actionForm = 'update';

        $this->dispatch('show-form');
    }

    /**
     * Updates the company details in the database.
     */
    public function update(): void
    {
        DB::transaction(function () {
            $data = $this->companyData();
            $data['updated_by'] = auth()->user()->id;

            $this->company->update($data);

            if ($this->oldCompanyCode != $this->company->code) {
                $this->dispatch('company-updated', $this->company->id);
            }
        }, 5);

        $this->dispatch('hide-form');
        $this->dispatch('refresh');
    }

    /**
     * Deletes the company from the database.
     */
    #[On('delete')]
    public function destroy($code): void
    {
        $this->company = Company::where('code', $code)->first();

        if (Branch::where('company_id', $this->company->id)->exists()) {
            $this->dispatch('company-has-branch');

            return;
        }

        $this->company->code = $this->company->code.time().'-deleted';
        $this->company->phone = $this->company->phone.time().'-deleted';
        $this->company->save();

        $this->company->delete();

        $this->dispatch('refresh');
    }

    /**
     * Dispatches a 'company-updated' event.
     */
    #[On('company-updated')]
    public function companyUpdated(): void
    {
        $tables = [
            'branches',
            'brands',
            'departments',
            'divisions',
            'sub_divisions',
            'levels',
            'positions',
            'user_details',
            'leave_plafonds',
            'leave_types',
        ];

        foreach ($tables as $table) {
            DB::table($table)->where('company_id', $this->company->id)->update([
                'company_code' => $this->company->code,
                'company_name' => $this->company->name,
                'updated_by' => auth()->user()->id,
            ]);
        }
    }

    #[On('clear-form')]
    public function clearForm(): void
    {
        $this->reset();
        $this->resetErrorBag();
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.company-form');
    }
}